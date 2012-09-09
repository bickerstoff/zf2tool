<?php

namespace Item\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Item\Form\ItemForm;

class ItemController extends AbstractActionController
{
    protected $itemsTable;
    
    public function indexAction()
    {
        return new ViewModel(array(
            'items' => $this->getItemsTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new ItemForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($this->getItemsTable()->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getItemsTable()->save($form->getData());

                // Redirect to list of albums
                return $this->redirect()->toRoute('item');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
       $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('item', array(
                'action' => 'add'
            ));
        }
        $item = $this->getItemsTable()->get($id);

        $form  = new ItemForm();
        $form->bind($item);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($this->getItemsTable()->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                    $this->getItemsTable()->save($form->getData());

                // Redirect to list of albums
                return $this->redirect()->toRoute('item');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('item');
        }
        $this->getItemsTable()->delete(array( 'id' => $id ));    
        return $this->redirect()->toRoute('item');
    }
    
    public function getItemsTable()
    {
        if (!$this->itemsTable) {
            $sm = $this->getServiceLocator();
            $this->itemsTable = $sm->get('Item\Model\ItemsTable');
        }
        return $this->itemsTable;
    }
    
}