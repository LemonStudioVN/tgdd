<div class="users form">
<?= $this->Flash->render() ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your username and password') ?></legend>
        <?= $this->Form->control('username') ?>
        <?= $this->Form->control('password') ?>
    </fieldset>
<?= $this->Form->button(__('Login')); ?>
<?= $this->Form->end() ?>
</div>

<?php 
    echo $this->Form->postLink(
        'Login with Facebook',
        [
            'plugin' => 'ADmad/SocialAuth',
            'controller' => 'Auth',
            'action' => 'login',
            'provider' => 'facebook',
            '?' => ['redirect' => $this->request->getQuery('redirect')]
        ]
    );
?>