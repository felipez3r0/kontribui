<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Area;
use Authorization\IdentityInterface;

/**
 * Area policy
 */
class AreaPolicy
{
    /**
     * Check if $user can create Area
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Area $resource
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Area $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('areas->add',$areas)){
            return true;
        }

        return false;        
    }

    /**
     * Check if $user can update Area
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Area $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Area $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('areas->edit',$areas)){
            return true;
        }

        return false;          
    }

    /**
     * Check if $user can delete Area
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Area $resource
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Area $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('areas->edit',$areas)){
            return true;
        }

        return false;          
    }

    /**
     * Check if $user can view Area
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Area $resource
     * @return bool
     */
    public function canIndex(IdentityInterface $user, Area $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('areas->index',$areas)){
            return true;
        }

        return false;
    }

    /**
     * Check if $user can view Area
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Area $resource
     * @return bool
     */
    public function canView(IdentityInterface $user, Area $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('areas->index',$areas)){
            return true;
        }

        return false;           
    }   
}
