<?php 
class PostsController extends AppController {
     public $helpers = array('Html', 'Form', 'Session', 'UploadPack.Upload');
 
     public $components = array('Search.Prg', 'Session'); 

     public $uses = array('Post', 'User', 'Category', 'Comment');
 
     public $paginate = array( 
         'Post' => array(
             'order' => array(
                 'modified' => 'desc' 
             ),
             'limit' => 10
         )
     );
 
     public function isAuthorized($user) {
         if ($this->action === 'add') {
            return true;
         }

         if (in_array($this->action, array('edit', 'delete'))) {
             $postId = (int) $this->request->params['pass']['0'];
             debug($this->Post->isOwnedBy($postId, $user['id']));
             if ($this->Post->isOwnedBy($postId, $user['id'])) {
                return true;
             }
         }
 
         return parent::isAuthorized($user);
     } 
 
     public function index() {
         $this->Prg->commonProcess();
         if (isset($this->passedArgs['search_word'])) {
             $conditions = $this->Post->parseCriteria($this->passedArgs);
             $this->set('conditions', $conditions);             
             $this->paginate = array(
                 'Post' => array(
                     'limit' => 10,
                     'order' => array(
                         'modified' => 'desc'
                     ),
                     'conditions' => $conditions 
                 )
             );
         }
        
         $this->set('posts', $this->paginate());
         $this->set('categories', $this->Category->find('all'));
     }
 
     public function categoryIndex($id = null) {
         if (!$id) {
             throw new NotFoundException(__('閲覧できません'));
         }
         $this->set($this->paginate(array(
             'Post.category_id' => $id)));
         $category = $this->Category->findById($id);  
         if(!$category) {
             throw new NotFoundException(__('閲覧できません'));
         }
 
         $this->set('category', $category); 
     }
 
     public function view($id = null) {
         if (!$id) {
             throw new NotFoundException(__('閲覧できません'));
         }
 
         $post = $this->Post->findById($id);
         if (!$post) {
             throw new NotFoundException(__('閲覧できません'));
         }
         
         $this->set('post', $post);
         if ($this->request->is('post')) {
             $user = $this->Auth->user();
             if(!$user) {
                 $this->Session->setFlash(__('コメントを送信できません'));
                 $this->redirect(array('controller' => 'posts', 'action' => 'view', $id));
             }
 
             $this->request->data['Comment']['user_id'] = $this->Auth->user('id');
             $this->request->data['Comment']['username'] = $this->Auth->user('username');
             $this->request->data['Comment']['post_id'] = $post['Post']['id'];
             $this->Comment->create();
             if ($this->Comment->save($this->request->data)) {
                 $this->Session->setFlash(__('コメントを送信しました'));
                 return $this->redirect(array('controller' => 'posts', 'action' => 'view', $id));
             }
 
             $this->Session->setFlash(__('コメントを送信できません'));
             return $this->redirect(array('controller' => 'posts', 'action' => 'view', $id));
         }
     }
 
     public function add() {
         $category = $this->Category->find('list',
             array(
                 'field' => array(
                     'Category.id', 'Category.name'
                 )
             )
         );
         
         $this->set('category', $category); 
         if ($this->request->is('post')) {
             $this->request->data['Post']['user_id'] = $this->Auth->user('id');
             $this->request->data['Post']['name'] = $this->Auth->user('username');
 
             $this->Post->create();
             if ($this->Post->saveAll($this->request->data)) {
                 $this->Session->setFlash(__('出品しました'));
                 return $this->redirect(array('controller' => 'posts', 'action' => 'index'));
             }
             $this->Session->setFlash(__('出品できません'));
         } 
 
     }
 
    public function edit($id = null) {
        $category = $this->Category->find('list',
             array(
                 'field' => array(
                     'Category.id', 'Category.name'
                 )
             )
         );
         $this->set('category', $category);
  
         if (!$id) {
             throw new NotFoundException(__('編集できません'));
         }
 
         $post = $this->Post->findById($id);
         if (!$post) {
             throw new NotFoundException(__('編集できません'));
         }
        
         $user = $this->Auth->user(); 
         if ($post['Post']['user_id'] !== $user['id']) {
             $this->Session->setFlash(__('編集できません'));
             return $this->redirect(array('controller' => 'posts', 'action' => 'index'));   
         }
 
         $this->set('post', $post);
         if ($this->request->is(array('post', 'put'))) {
             $this->Post->id = $id;
             if ($this->Post->saveAll($this->request->data)) {
                 $this->Session->setFlash(__('編集しました'));
                 return $this->redirect(array('controller' => 'posts', 'action' => 'index'));
             }
             $this->Session->setFlash(__('編集できません'));
         }
 
         if (!$this->request->data) {
             $this->request->data = $post;
         }
    }
     
    public function delete($id) {
        $user = $this->Auth->user();
        $post = $this->Post->findById($id);
        if ($post['Post']['user_id'] !== $user['id']) {
            $this->Session->setFlash(__('削除できません'));
            return $this->redirect(array('controller' => 'posts','action' => 'index'));
        }
 
        if ($this->Post->delete($id)) {
            $this->Session->setFlash(__('削除しました'));
            return $this->redirect(array('controller' => 'posts','action' => 'index'));
        }
    }
} 
