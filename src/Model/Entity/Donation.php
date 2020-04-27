<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Donation Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime|null $dateContact
 * @property int $project_id
 * @property int $user_id
 *
 * @property \App\Model\Entity\Project $project
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Part[] $parts
 */
class Donation extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'dateContact' => true,
        'project_id' => true,
        'user_id' => true,
        'project' => true,
        'user' => true,
        'parts' => true,
    ];
}
