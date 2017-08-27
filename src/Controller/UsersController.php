<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Core\Configure;
use Cake\Http\ServerRequest;

define('QUERY_STRING_REDIRECT', 'redirect');
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize() 
    {
        parent::initialize();
        $this->user = $this->Auth->user();
    }
    
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['add', 'logout', 'facebookLogin', 'facebookLoginCallback']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function facebookLogin()
    {
        $this->_setRedirectUrl($this->request);
        $callbackUrl = Router::url([
            'controller' => 'Users', 
            'action' => 'facebookLoginCallback',
            '_full' => true]);
        $loginUrl = $this->fbHelper->getLoginUrl($callbackUrl, $this->permissions);
        $this->redirect($loginUrl);
    }

    public function facebookLoginCallback()
    {
        $session = $this->request->session();
        try {
            $accessToken = $this->fbHelper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            return;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            return;
        }

        if (!isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            return;
        }
        
        $oAuth2Client = $this->fb->getOAuth2Client();
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
        $tokenMetadata->validateAppId(Configure::read('Facebook.app_id'));
        $tokenMetadata->validateExpiration();
        if (!$accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
                return;
            }
        }

        $session->write('fb_access_token', (string) $accessToken);
        $fb_access_token = $session->read('fb_access_token');
        if (!empty($fb_access_token)) {
            try {
                // Returns a `Facebook\FacebookResponse object
                $response = $this->fb->get('/me?fields=email,name,gender,first_name,last_name', $fb_access_token);
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }
            $usernode = $response->getGraphUser();
            $user = $this->Users->authUser($usernode);
            $this->Auth->setUser($user);
            
            $redirectUrl = $session->read('SocialAuth.redirectUrl');
            if ($redirectUrl) {
                $session->delete('SocialAuth.redirectUrl');
                return $this->redirect($redirectUrl);
            }
            return $this->redirect($this->Auth->redirectUrl());
        }        

    }

    protected function _setRedirectUrl(ServerRequest $request)
    {
        $request->session()->delete('SocialAuth.redirectUrl');

        $queryParams = $request->getQueryParams();
        if (empty($queryParams[QUERY_STRING_REDIRECT])) {
            return;
        }

        $redirectUrl = $queryParams[QUERY_STRING_REDIRECT];
        if (substr($redirectUrl, 0, 1) !== '/'
            || substr($redirectUrl, 0, 2) === '//'
        ) {
            return;
        }

        $request->session()->write('SocialAuth.redirectUrl', $redirectUrl);
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['SocialProfiles']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
