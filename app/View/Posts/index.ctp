<!-- File: /app/View/Post/index.ctp (edit links added) -->

<h1>Blog Posts</h1>

<?php 
	echo $this->Html->link('Novo Post', array('controller' => 'posts', 'action' => 'add')) 
?>

<table>
	<tr>
		<th>ID</th>
		<th>Titulo</th>
		<th>A&ccedil;&atilde;o</th>
		<th>Criado em</th>
	</tr>
	
	<!-- Aqui é um Loop para pegar nosso array $post, imprimir na saida -->
	<?php foreach ($posts as $post): ?>
	<tr>
		<td><?php echo $post['Post']['id']; ?></td>
		
        <td>
            <?php 
            	echo $this->Html->link(
						$post['Post']['title'],
						array('action' => 'view', $post['Post']['id'])
				); 
			?>
        </td>
        
        <td>
        	<?php
				echo $this->Form->postLink(
					'Delete',
					array('action' => 'delete', $post['Post']['id']),
					array('confirm' => "Deseja realmente deletar o registro: \n"
						. $post['Post']['id'] . ' - ' . $post['Post']['title'])
				);
        	?>
        	<?php
        		echo $this->Html->link(
					'Editar', 
					array('action' => 'edit', $post['Post']['id'])
        		)
        	?>
        </td>
        
        <td><?php echo $post['Post']['created']; ?></td>
	</tr>
	<?php endforeach;?>
	<?php unset($post);?>

</table>