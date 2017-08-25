<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User $user
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Social Profiles'), ['controller' => 'SocialProfiles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Social Profile'), ['controller' => 'SocialProfiles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= h($user->role) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Social Profiles') ?></h4>
        <?php if (!empty($user->social_profiles)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Provider') ?></th>
                <th scope="col"><?= __('Access Token') ?></th>
                <th scope="col"><?= __('Identifier') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('First Name') ?></th>
                <th scope="col"><?= __('Last Name') ?></th>
                <th scope="col"><?= __('Full Name') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Birth Date') ?></th>
                <th scope="col"><?= __('Picture') ?></th>
                <th scope="col"><?= __('Gender') ?></th>
                <th scope="col"><?= __('Email Verified') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->social_profiles as $socialProfiles): ?>
            <tr>
                <td><?= h($socialProfiles->id) ?></td>
                <td><?= h($socialProfiles->user_id) ?></td>
                <td><?= h($socialProfiles->provider) ?></td>
                <td><?= h($socialProfiles->access_token) ?></td>
                <td><?= h($socialProfiles->identifier) ?></td>
                <td><?= h($socialProfiles->username) ?></td>
                <td><?= h($socialProfiles->first_name) ?></td>
                <td><?= h($socialProfiles->last_name) ?></td>
                <td><?= h($socialProfiles->full_name) ?></td>
                <td><?= h($socialProfiles->email) ?></td>
                <td><?= h($socialProfiles->birth_date) ?></td>
                <td><?= h($socialProfiles->picture) ?></td>
                <td><?= h($socialProfiles->gender) ?></td>
                <td><?= h($socialProfiles->email_verified) ?></td>
                <td><?= h($socialProfiles->created) ?></td>
                <td><?= h($socialProfiles->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SocialProfiles', 'action' => 'view', $socialProfiles->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SocialProfiles', 'action' => 'edit', $socialProfiles->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SocialProfiles', 'action' => 'delete', $socialProfiles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $socialProfiles->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
