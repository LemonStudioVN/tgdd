<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\EntityInterface;
use Facebook\GraphNodes\GraphNodeFactory;

/**
 * Users Model
 *
 * @property \App\Model\Table\SocialProfilesTable|\Cake\ORM\Association\HasMany $SocialProfiles
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('SocialProfiles', [
            'foreignKey' => 'user_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('username')
            ->allowEmpty('username');

        $validator
            ->scalar('password')
            ->allowEmpty('password');

        $validator
            ->scalar('role')
            ->allowEmpty('role');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['username']));

        return $rules;
    }

    public function getUser(EntityInterface $profile) {
        // Make sure here that all the required fields are actually present
        if (empty($profile->email)) {
            throw new \RuntimeException('Could not find email in social profile.');
        }
    
        // Check if user with same email exists. This avoids creating multiple
        // user accounts for different social identities of same user. You should
        // probably skip this check if your system doesn't enforce unique email
        // per user.
        $user = $this->find()
            ->where(['email' => $profile->email])
            ->first();
    
        if ($user) {
            return $user;
        }
    
        // Create new user account
        $user = $this->newEntity(['email' => $profile->email]);
        $user = $this->save($user);
    
        if (!$user) {
            throw new \RuntimeException('Unable to save new user');
        }
    
        return $user;
    }

    public function authUser($profile)
    {
        $email = $profile->getProperty('email');
        if (empty($email)) {
            throw new \RuntimeException('Could not find email in social profile.');
        }

        $user = $this->find()
            ->where(['email' => $email])
            ->first();
    
        if ($user) {
            return $user;
        }
    
        // Create new user account
        $user = $this->newEntity([
            'email' => $email,
            'username' => $profile->getProperty('name'),
            'password' => time()
            ]);
        $user = $this->save($user);
    
        if (!$user) {
            throw new \RuntimeException('Unable to save new user');
        }
    
        return $user;
    }
}
