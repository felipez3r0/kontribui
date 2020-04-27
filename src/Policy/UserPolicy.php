<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\User;
use Authorization\IdentityInterface;

/**
 * User policy
 */
class UserPolicy
{
    /**
     * Check if $user can create User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canAdd(IdentityInterface $user, User $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('users->add',$areas)){
            return true;
        }

        return false;        
    }

    /**
     * Check if $user can update User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, User $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('users->edit',$areas) || $this->isUser($user->getOriginalData()->id, $resource)){
            return true;
        }

        return false;          
    }

    /**
     * Check if $user can delete User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canDelete(IdentityInterface $user, User $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('users->edit',$areas)){
            return true;
        }

        return false;          
    }

    /**
     * Check if $user can view User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canIndex(IdentityInterface $user, User $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('users->index',$areas)){
            return true;
        }

        return false;
    }

    /**
     * Check if $user can view User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canView(IdentityInterface $user, User $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('users->index',$areas) || $this->isUser($user->getOriginalData()->id, $resource)){
            return true;
        }

        return false;           
    }   
    
    protected function isUser($id, User $user)
    {
        return $user->id === $id;
    }    
}
