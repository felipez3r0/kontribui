<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Profile;
use Authorization\IdentityInterface;

/**
 * Profile policy
 */
class ProfilePolicy
{
    /**
     * Check if $user can create Profile
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Profile $resource
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Profile $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('profiles->add',$areas)){
            return true;
        }

        return false;        
    }

    /**
     * Check if $user can update Profile
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Profile $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Profile $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('profiles->edit',$areas) || $this->isUser($user->getOriginalData()->id, $resource)){
            return true;
        }

        return false;          
    }

    /**
     * Check if $user can delete Profile
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Profile $resource
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Profile $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('profiles->edit',$areas)){
            return true;
        }

        return false;          
    }

    /**
     * Check if $user can view Profile
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Profile $resource
     * @return bool
     */
    public function canIndex(IdentityInterface $user, Profile $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('profiles->index',$areas)){
            return true;
        }

        return false;
    }

    /**
     * Check if $user can view Profile
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Profile $resource
     * @return bool
     */
    public function canView(IdentityInterface $user, Profile $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('profiles->index',$areas) || $this->isUser($user->getOriginalData()->id, $resource)){
            return true;
        }

        return false;           
    }   
    
    protected function isUser($id, Profile $project)
    {
        return $project->user_id === $id;
    }    
}
