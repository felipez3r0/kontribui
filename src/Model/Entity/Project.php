<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Project Entity
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime|null $dateCreated
 * @property int|null $status
 * @property int $user_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Donation[] $donations
 * @property \App\Model\Entity\Part[] $parts
 * @property \App\Model\Entity\Tag[] $tags
 */
class Project extends Entity
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
        'title' => true,
        'description' => true,
        'dateCreated' => true,
        'status' => true,
        'user_id' => true,
        'user' => true,
        'donations' => true,
        'parts' => true,
        'tags' => true,
    ];
}
