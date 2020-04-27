<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Group;
use Authorization\IdentityInterface;

/**
 * Group policy
 */
class GroupPolicy
{
    /**
     * Check if $user can create Group
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Group $resource
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Group $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('groups->add',$areas)){
            return true;
        }

        return false;        
    }

    /**
     * Check if $user can update Group
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Group $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Group $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('groups->edit',$areas)){
            return true;
        }

        return false;          
    }

    /**
     * Check if $user can delete Group
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Group $resource
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Group $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('groups->edit',$areas)){
            return true;
        }

        return false;          
    }

    /**
     * Check if $user can view Group
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Group $resource
     * @return bool
     */
    public function canIndex(IdentityInterface $user, Group $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('groups->index',$areas)){
            return true;
        }

        return false;
    }

    /**
     * Check if $user can view Group
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Group $resource
     * @return bool
     */
    public function canView(IdentityInterface $user, Group $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('groups->index',$areas)){
            return true;
        }

        return false;           
    }   
}
