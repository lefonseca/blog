<?php

class PostsController extends AppController {
	public $helpers = array('html', 'Form');
	public $components = array('Session');
	
	public function index(){
		$this->set('posts', $this->Post->find('all'));
	}
	
	public function view($id = null){
		if (!$id) {
			throw new NotFoundException(__('Post Invalido'));
		}
		
		$post = $this->Post->findById($id);
		if (!$post) {
			throw new NotFoundException(__('Post Invalido'));
		}
		
		$this->set('post', $post);
	}
	
	public function add(){
		if ($this->request->is('post')){
			$this->Post->create();
			
			if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('Post inserido com sucesso!'));
                return $this->redirect(array('action' => 'index'));
            }
			
			$this->Session->setFlash(__('Seu post não foi adicionado.'));
		}
	}
	
	public function edit($id = nill){
		if (!$id) {
			throw new NotFoundException(__('Post Invalido'));
		}
		
		$post = $this->Post->findById($id);
		if (!$post) {
			throw new NotFoundException(__('Post Invalido'));
		}
		
		if ($this->request->is(array('post', 'put'))){
			$this->Post->id = $id;
			
			if ($this->Post->save($this->request->data)){
				$this->Session->setFlash(__('Post atualizado com sucesso!'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('Não foi possível atualizar o post.'));
		}
		
		if (!$this->request->data){
			$this->request->data = $post;
		}
	}
	
	public function delete($id){
		if($this->request->is('get')){
			throw new MethodNotAllowedException();
		}
		
		if ($this->Post->delete($id)) {
			$this->Session->setFlash(__('O post com ID: %s foi apagado com sucesso!', h($id)));
			return $this->redirect(array('action' => 'index'));
		}
	}
}