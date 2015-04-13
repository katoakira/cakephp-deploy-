<?php
App::uses('AppController', 'Controller');
class CategoriesController extends AppController {
    public $helpers = array('Html', 'Form', 'Session'); 

    public $components = array('Paginator', 'Session');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'edit', 'delete'); 
    }

	public function index() {
        $this->set('categories', $this->Category->find('all'));
	}

	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('無効なカテゴリー'));
        }

        $category = $this->Category->findById($id);
        if(!$category) {
           throw new NotFoundException(__('無効なカテゴリー'));
        }

        $category = $this->Category->findById($id);
        if(!$category) {
            throw new NotFoundException(__('無効なカテゴリー'));
        }

        $this->set('category', $category);
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('カテゴリーを追加しました'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('カテゴリーを追加できません。もう一度入力してください。'));
			}
		}
	}

	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('無効なカテゴリー'));
        }

        $category = $this->Category->findById($id);    
        $this->set('category', $category);
        if ($this->request->is(array('post', 'put'))) {
            $this->Category->id = $id;
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('カテゴリーを編集しました'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('カテゴリーを編集できません。もう一度入力してください。'));
			}
        }

        if(!$this->request->data) {
            $this->request->data = $category;
        }
	}

    public function delete($id = null) {
        if($this->request->is('get')) {
           throw new MethodNotAllowedException();
        }
        
        $category = $this->Category->findById($id);
        if ($this->Category->delete($id)) {
            $this->Session->setFlash(__('削除しました'));
            return $this->redirect(array('action' => 'index'));
        }
            $this->Session->setFlash(__('削除できません'));
	}
}
