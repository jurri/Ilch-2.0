<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\User\Controllers\Admin;

use Modules\User\Controllers\Admin\Base as BaseController;
use Modules\User\Mappers\Profilfields as ProfilfieldsMapper;
use Modules\User\Mappers\Group as GroupMapper;
use Modules\User\Models\Profilfields as ProfilfieldsModel;
use Modules\User\Models\Group as GroupModel;

class Profilfields extends BaseController
{
    public function init()
    {
        parent::init();
        $this->getLayout()->addMenuAction
        (
            array
            (
                'name' => 'menuActionNewProfilfields',
                'icon' => 'fa fa-plus-circle',
                'url'  => $this->getLayout()->getUrl(array('controller' => 'profilfields', 'action' => 'treat'))
            )
        );
    }



    public function indexAction() 
    {
        $this->getLayout()->getAdminHmenu()
                ->add($this->getTranslator()->trans('menuProfilfields'), array('action' => 'index'));

        $profilfieldsMapper = new ProfilfieldsMapper();

        if ($this->getRequest()->isPost()) {
            
            $this->addMessage('saveSuccess');
        }
        $profilfieldList = $profilfieldsMapper->getProfilfieldList();
        $this->getView()->set('userList', $profilfieldList);
    }

    /**
     * Shows a form to create or edit a new user.
     */
    public function treatAction()
    {
        $this->getLayout()->getAdminHmenu()
                ->add($this->getTranslator()->trans('menuProfilfields'), array('action' => 'index'))
                ->add($this->getTranslator()->trans('editProfilfields'), array('action' => 'treat'));

        $profilfieldsMapper = new ProfilfieldsMapper();

        if ($this->getRequest()->isPost()) {
            $userData = $this->getRequest()->getPost('profilfields');
            
        }

        if (empty($userId)) {
            $userId = $this->getRequest()->getParam('id');
        }

        if ($profilfieldsMapper->userWithIdExists($userId)) {
            $user = $profilfieldsMapper->getUserById($userId);
        }
        else {
            $user = new ProfilfieldsModel();
        }

        $groupMapper = new GroupMapper();

        $this->getView()->set('user', $user);
        $this->getView()->set('groupList', $groupMapper->getGroupList());
    }
}
