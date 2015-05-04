<?php
/**
 * Template Name: Página de Exemplo
 * 
 * O template para exibir todos os formatos HTML suportados e estilizados pelo tema
 * 
 * @package Estúdio Viking
 * @since 1.0
 */

get_header();
?>
	
<main id="principal" class="col_8" role="main">
	
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="post-header">
					<h1 id="page-title"><?php the_title(); ?></h1>
			</header><!-- .post header -->
			
			<?php edit_post_link( __( 'Edit', 'viking-theme' ), '<span class="edit-link">', '</span>' ); ?>
	
			<section class="post-content">
				
				<?php the_content(); ?>
				
				<p>
					Abaixo é apenas uma demostração cada elemento <abbr title="HyperText Markup Language">HTML</abbr>, você pode querer usar em seus posts. Verifique o código fonte para ver os muitos elementos incorporados nos parágrafos.
				</p>
				
				<hr>
				
				<h1>Exemplo de Cabeçalho 1</h1>
				<h2>Exemplo de Cabeçalho 2</h2>
				<h3>Exemplo de Cabeçalho 3</h3>
				<h4>Exemplo de Cabeçalho 4</h4>
				<h5>Exemplo de Cabeçalho 5</h5>
				<h6>Exemplo de Cabeçalho 6</h6>
				
				<hr>
				
				<p>
					Lorem ipsum dolor sit amet, <a href="#" title="link de teste">link de test</a> adipiscing elit. <strong>Isso é um strong.</strong> Nullam dignissim convallis est. Quisque aliquam. <em>Isso é uma ênfase.</em> Donec faucibus. Nunc iaculis suscipit dui. Você sabia que 5<sup>3</sup> = 125. Água é H<sub>2</sub>O. Nam sit amet sem. Aliquam libero nisi, imperdiet at, tincidunt nec, gravida vehicula, nisl. <cite>The New York Times</cite> (Isso é uma citação). <span style="text-decoration:underline;">Sublinhado.</span> Maecenas ornare tortor. Donec sed tellus eget sapien fringilla nonummy. Mauris a ante. Suspendisse quam sem, consequat at, commodo vitae, feugiat in, nunc. Morbi imperdiet augue quis tellus. <abbr title="HyperText Markup Language">HTML</abbr> e <abbr title="Cascading Style Sheets">CSS</abbr> são nossas ferramentas. Mauris a ante. Suspendisse quam sem, consequat at, commodo vitae, feugiat in, nunc. Morbi imperdiet augue quis tellus.
					Praesent mattis, massa quis luctus fermentum, turpis mi volutpat justo, eu volutpat enim diam eget metus. Para copiar um arquivo digite <code>COPY <var>nome_do_arquivo</var></code>.
				</p>
				<p>
					<del>O jantar é às 5:00.</del> <ins>Melhor às 7:00.</ins>
				</p>
				<p>
					Esse <span style="text-decoration: line-through;">texto</span> foi rasurado.
				</p>
				
				<hr>
				
				<h3>Tipos de Lista</h3>
				<h4>Listas de Descrição</h4>
				<dl>
					<dt>Título da Lista de Descrição</dt>
					<dd>Essa é uma divisão da lista de descrição.</dd>
					<dt>Definição</dt>
					<dd>Uma declaração exata ou descrição da natureza, o alcance, ou o significado de uma coisa: <em>a nossa definição do que constitui a poesia</em>.</dd>
				</dl>
				
				<h4>Lista Ordenada</h4>
				<ol>
					<li>Item 1</li>
					<li>Item 2
						<ol>
							<li>Item aninhado a</li>
							<li>Item aninhado b
								<ol>
									<li>Item aninhado A</li>
									<li>Item aninhado B</li>
									<li>Item aninhado C</li>
								</ol>
							</li>
							<li>Item aninhado c</li>
						</ol>
					</li>
					<li>Item 3</li>
				</ol>
				
				<h4>List Não-Ordenada</h4>
				<ul>
					<li>Item 1</li>
					<li>Item 2
						<ul>
							<li>Item aninhado a</li>
							<li>Item aninhado b
								<ul>
									<li>Item aninhado A</li>
									<li>Item aninhado B</li>
									<li>Item aninhado C</li>
								</ul>
							</li>
							<li>Item aninhado c</li>
						</ul>
					</li>
					<li>Item 3</li>
				</ul>
				
				<hr>
				
				<h3>Tabela</h3>
				<table>
					<caption>Tabela de Exemplo - Isso é um <code>&lt;caption&gt;</code></caption>
					<thead>
						<tr>
							<th>Cabeçalho da tabela 1</th>
							<th>Cabeçalho da tabela 2</th>
							<th>Cabeçalho da tabela 3</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Divisão 1</td>
							<td>Divisão 2</td>
							<td>Divisão 3</td>
						</tr>
						<tr>
							<td>Divisão 1</td>
							<td>Divisão 2</td>
							<td>Divisão 3</td>
						</tr>
						<tr>
							<td>Divisão 1</td>
							<td>Divisão 2</td>
							<td>Divisão 3</td>
						</tr>
						<tr>
							<td>Divisão 1</td>
							<td>Divisão 2</td>
							<td>Divisão 3</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="3">Rodapé da tabela</td>
						</tr>
					</tfoot>
				</table>
				
				<hr>
				
				<h3>Texto Pré-formatado</h3>
				<p>
					Tipograficamente, texto pré-formatado não é a mesma coisa que código. Às vezes, uma execução fiel do texto requer texto pré-formatado que pode não ter nada a ver com o código. Por exemplo:
				</p>
				<pre>"Cuidado com o Jaguadarte, meu filho!
	Mandíbula mordendo, garras pegando!
Cuidado com a ave Sobe-Sobe
	e se esconda do bravioso Vaimurrando!"</pre>
	    		
				<h3>Código</h3>
				<p>
					Códigos podem ser exibidos inline, como por exemplo <code>&lt;?php bloginfo( 'stylesheet_url' ); ?&gt;</code>, ou dentro de um bloco <code>&lt;pre&gt;</code>.
				</p>
				<pre><code>#container { float: left; margin: 0 -240px 0 0; width: 100%; }</code></pre>
				
				<hr>
				
				<h3>Blockquotes</h3>
				<p>
					Vamos mantê-lo simples.
				</p>
				<blockquote>
					<p>
						Boa tarde, cabalheiros. Eu sou um computador HAL 9000. Me tornei operacional na fábrica H.A.L. em Urbana, Illinois em 12 de Janeiro de 1992. Meu instrutor foi o Sr. Langley, e ele ensinou a cantar uma canção. Você gostaria de ouví-la. Eu posso cantá-la para você. <cite>&mdash; <a href="http://en.wikipedia.org/wiki/HAL_9000">HAL 9000</a></cite>
					</p>
				</blockquote>
				<p>
					E aqui está um pouco de texto posterior.
				</p>
				
				<hr>
				
				<h3>Formulários</h3>
				<p>
					Veremos como fica a apresentação padrão dos elementos de um formulário.
				</p>
				<form action="" id="form-example">
					<p>
						O <code>&lt;fieldset&gt;</code> agrupa elementos relacionados de um formulário.
					</p>
					<fieldset>
						<legend>Essa é a legenda de um <code>&lt;fieldset&gt;</code></legend>
						<div class="form-group">
							<label for="input">Esse é o <code>&lt;label&gt;</code></label>
							<input type="text" name="input" placeholder="Isso é um input de texto" />
						</div>
						<div class="form-group">
							<label for="file">Selecione um arquivo:</label>
							<input type="file" name="file" placeholder="Isso é um input de arquivo" />
						</div>
						<div class="form-group">
							<label for="url">Digite seu site:</label>
							<input type="url" name="url" placeholder="Isso é um input do tipo url" />
						</div>
						<div class="form-group">
							<label for="textarea">Esse é outro <code>&lt;label&gt;</code></label>
							<textarea name="textarea" placeholder="Isso é uma área de texto"></textarea>
						</div>
					</fieldset>
					<p>
						Elementos de um <code>&lt;select&gt;</code>.
					</p>
					<div class="form-group">
						<label for="select">Selecione uma opção:</label>
						<select name="select">
							<optgroup label="Grupo 1">
								<option value="1">Opção 1</option>
								<option value="2">Opção 2</option>
								<option value="3">Opção 3</option>
							</optgroup>
							<optgroup label="Grupo 2">
								<option value="1">Opção 1</option>
								<option value="2">Opção 2</option>
								<option value="3">Opção 3</option>
							</optgroup>
						</select>
					</div>
					<div class="form-group">
						<label for="radio">Botões Radio:</label>
						<input name="radio" type="radio" value="radio_1" /> Radio 1
						<input name="radio" type="radio" value="radio_2" /> Radio 2
						<input name="radio" type="radio" value="radio_3" /> Radio 3
					</div>
					<div class="form-group">
						<label for="checkbox">Checkboxes:</label>
						<input name="checkbox" type="checkbox" value="check_1" /> Checkbox 1
						<input name="checkbox" type="checkbox" value="check_2" /> Checkbox 2
						<input name="checkbox" type="checkbox" value="check_3" /> Checkbox 3
					</div>
				</form>
			</section><!-- .post content -->
		</article><!-- #post## -->
	
</main><!-- #principal -->

<?php
get_footer();