<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Part Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $quantity
 * @property string|null $balance
 * @property int $project_id
 *
 * @property \App\Model\Entity\Project $project
 * @property \App\Model\Entity\Donation[] $donations
 * @property \App\Model\Entity\Tag[] $tags
 */
class Part extends Entity
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
        'name' => true,
        'description' => true,
        'quantity' => true,
        'balance' => true,
        'project_id' => true,
        'project' => true,
        'donations' => true,
        'tags' => true,
    ];
}
