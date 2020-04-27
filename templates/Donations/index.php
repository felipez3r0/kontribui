<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Donation[]|\Cake\Collection\CollectionInterface $donations
 */
?>
<div class="donations index content">
    <?= $this->Html->link(__('New Donation'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Donations') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('dateContact') ?></th>
                    <th><?= $this->Paginator->sort('project_id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($donations as $donation): ?>
                <tr>
                    <td><?= $this->Number->format($donation->id) ?></td>
                    <td><?= h($donation->dateContact) ?></td>
                    <td><?= $donation->has('project') ? $this->Html->link($donation->project->title, ['controller' => 'Projects', 'action' => 'view', $donation->project->id]) : '' ?></td>
                    <td><?= $donation->has('user') ? $this->Html->link($donation->user->name, ['controller' => 'Users', 'action' => 'view', $donation->user->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $donation->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $donation->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $donation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $donation->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
