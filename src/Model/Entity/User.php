<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Authentication\PasswordHasher\DefaultPasswordHasher;
/**
 * User Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $password
 *
 * @property \App\Model\Entity\Group[] $groups
 */
class User extends Entity
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
        'email' => true,
        'password' => true,
        'groups' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    protected function _setPassword(string $password) : ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
    }
    
    protected function _getAreasList()
    {
        $users = TableRegistry::getTableLocator()->get('Users');
        $user = $users->find()->where(['id'=>$this->id])->contain(['Groups'=>['Areas']])->first();
        $areas = [];
        foreach($user->groups as $group){
            foreach($group->areas as $area){
                $areas[] = $area->controller.'->'.$area->action;
            }
        }

        return $areas;
    }    
}
