<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Donation $donation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Donation'), ['action' => 'edit', $donation->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Donation'), ['action' => 'delete', $donation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $donation->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Donations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Donation'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="donations view content">
            <h3><?= h($donation->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Project') ?></th>
                    <td><?= $donation->has('project') ? $this->Html->link($donation->project->title, ['controller' => 'Projects', 'action' => 'view', $donation->project->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $donation->has('user') ? $this->Html->link($donation->user->name, ['controller' => 'Users', 'action' => 'view', $donation->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($donation->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('DateContact') ?></th>
                    <td><?= h($donation->dateContact) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Parts') ?></h4>
                <?php if (!empty($donation->parts)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th><?= __('Balance') ?></th>
                            <th><?= __('Project Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($donation->parts as $parts) : ?>
                        <tr>
                            <td><?= h($parts->id) ?></td>
                            <td><?= h($parts->name) ?></td>
                            <td><?= h($parts->description) ?></td>
                            <td><?= h($parts->quantity) ?></td>
                            <td><?= h($parts->balance) ?></td>
                            <td><?= h($parts->project_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Parts', 'action' => 'view', $parts->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Parts', 'action' => 'edit', $parts->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Parts', 'action' => 'delete', $parts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parts->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
