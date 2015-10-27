<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\Faq\Controllers\Admin;

use Modules\Faq\Mappers\Category as CategoryMapper;
use Modules\Faq\Models\Category as CategoryModel;
use Modules\Faq\Mappers\Faq as FaqMapper;

class Cats extends \Ilch\Controller\Admin
{
    public function init()
    {
        $this->getLayout()->addMenu
        (
            'menuFaqs',
            array
            (
                array
                (
                    'name' => 'menuFaqs',
                    'active' => false,
                    'icon' => 'fa fa-th-list',
                    'url' => $this->getLayout()->getUrl(array('controller' => 'index', 'action' => 'index'))
                ),
                array
                (
                    'name' => 'menuCats',
                    'active' => true,
                    'icon' => 'fa fa-th-list',
                    'url'  => $this->getLayout()->getUrl(array('controller' => 'cats', 'action' => 'index'))
                ),
            )
        );

        $this->getLayout()->addMenuAction
        (
            array
            (
                'name' => 'add',
                'icon' => 'fa fa-plus-circle',
                'url'  => $this->getLayout()->getUrl(array('controller' => 'cats', 'action' => 'treat'))
            )
        );
    }

    public function indexAction() 
    {
        $categoryMapper = new CategoryMapper();
        
        $this->getLayout()->getAdminHmenu()
                ->add($this->getTranslator()->trans('menuFaqs'), array('controller' => 'index', 'action' => 'index'))
                ->add($this->getTranslator()->trans('menuCats'), array('action' => 'index'));

        if ($this->getRequest()->getPost('action') === 'delete') {
            foreach ($this->getRequest()->getPost('check_cats') as $catId) {
                $categoryMapper->delete($catId);
            }
            $this->addMessage('deleteSuccess');

            $this->redirect(array('action' => 'index'));
        }

        $this->getView()->set('cats', $categoryMapper->getCategories());
    }

    public function treatAction() 
    {        
        $categoryMapper = new CategoryMapper();

        if ($this->getRequest()->getParam('id')) {
            $this->getLayout()->getAdminHmenu()
                    ->add($this->getTranslator()->trans('menuFaqs'), array('action' => 'index'))
                    ->add($this->getTranslator()->trans('menuCats'), array('action' => 'index'))
                    ->add($this->getTranslator()->trans('edit'), array('action' => 'treat'));
        
            $this->getView()->set('cat', $categoryMapper->getCategoryById($this->getRequest()->getParam('id')));
        } else {
            $this->getLayout()->getAdminHmenu()
                    ->add($this->getTranslator()->trans('menuFaqs'), array('action' => 'index'))
                    ->add($this->getTranslator()->trans('menuCats'), array('action' => 'index'))
                    ->add($this->getTranslator()->trans('add'), array('action' => 'treat'));            
        }

        if ($this->getRequest()->isPost()) {
            $model = new CategoryModel();

            if ($this->getRequest()->getParam('id')) {
                $model->setId($this->getRequest()->getParam('id'));
            }
            
            $title = trim($this->getRequest()->getPost('title'));
            
            if (empty($title)) {
                $this->addMessage('missingTitle', 'danger');
            } else {
                $model->setTitle($title);
                $categoryMapper->save($model);
                
                $this->addMessage('saveSuccess');
                
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function delCatAction()
    {        
        $faqMapper = new FaqMapper();
        $countFaqs = count($faqMapper->getFaqs(array('cat_id' => $this->getRequest()->getParam('id'))));

        if ($countFaqs == 0) {
            if ($this->getRequest()->isSecure()) {
                $categoryMapper = new CategoryMapper();
                $categoryMapper->delete($this->getRequest()->getParam('id'));

                $this->addMessage('deleteSuccess');

                $this->redirect(array('action' => 'index'));
            }
        } else {
            $this->addMessage('deleteFailed', 'danger'); 

            $this->redirect(array('action' => 'index'));         
        }
    }
}
