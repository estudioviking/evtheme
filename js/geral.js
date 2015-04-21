( function( $ ) {
	var $window, $body, $sidebar, windowHeight, bodyHeight, sidebarHeight, top = false,
	    bottom = false, topOffset = 0, lastWindowPos = 0, scrollLenght, scrollDif;
	
	// Controla o visual do tema dependendo da largura da janela
	function resize() {
		windowWidth   = $window.width();

		if ( 900 > windowWidth ) {
			top = bottom = false;
			$sidebar.removeAttr( 'style' );
		} else {
			$sidebar.find( '#nav-header' ).removeAttr( 'style' );
		}
	}
	
	// Controla a posição da sidebar conforme o scroll da janela
	function scroll() {
		windowWidth		 = $window.width();
		windowHeight	 = $window.height();
		bodyHeight		 = $body.height();
		sidebarHeight	 = $sidebar.height();
		windowPos		 = $window.scrollTop();
		sidebarTopOffset = $sidebar.offset().top;
		scrollUp		 = windowPos > lastWindowPos ? true : false;
		scrollDown		 = windowPos < lastWindowPos ? true : false;
		
		if ( 900 > windowWidth ) {
			return;
		}
		
		// Se a sidebar for maior que o tamanho da janela...
		if ( sidebarHeight > windowHeight ) {
			if ( scrollUp ) {
				if ( top ) {
					top = false;
					topOffset = ( sidebarTopOffset > 0 ) ? sidebarTopOffset : 0;
					$sidebar.attr( 'style', 'top: ' + topOffset + 'px;' );
				} else if ( ! bottom && windowPos + windowHeight > sidebarHeight + sidebarTopOffset && sidebarHeight < bodyHeight ) {
					bottom = true;
					$sidebar.attr( 'style', 'position: fixed; bottom: 0;' );
				}
			} else if ( scrollDown ) {
				if ( bottom ) {
					bottom = false;
					topOffset = ( sidebarTopOffset > 0 ) ? sidebarTopOffset : 0;
					$sidebar.attr( 'style', 'top: ' + topOffset + 'px;' );
				} else if ( ! top && windowPos < sidebarTopOffset ) {
					top = true;
					$sidebar.attr( 'style', 'position: fixed;' );
				}
			} else {
				top = bottom = false;
				topOffset = ( sidebarTopOffset > 0 ) ? sidebarTopOffset : 0;
				$sidebar.attr( 'style', 'top: ' + topOffset + 'px;' );
			}
		} else if ( ! top ) {
			top = true;
			$sidebar.attr( 'style', 'position: fixed;' );
		}

		lastWindowPos = windowPos;
	}
	
	// Executa as funções resize e scroll
	function resize_and_scroll() {
		resize();
		scroll();
	}
	
	$( document ).ready( function() {
		$window	 = $( window );
		$body	 = $( document.body );
		$sidebar = $( '#sidebar' ).first();
		
		// Executando a função resize_and_scroll
		resize_and_scroll();
		$window.scroll( resize_and_scroll );
		$window.resize( resize_and_scroll );
		
		// Função ao clicar no botão #toggle
		$( '#toggle' ).click( function() {
			$( '#nav-header' ).slideToggle();
		} );
		
		// Ajustes da paginação dos artigos
		$( '.pagination .prev, .pagination .next' ).addClass( 'button' ).removeClass( 'page-numbers' );
		
		// Adicionando a classe .radius2
		$( 'form, fildset, input, button, .button, .input-group, textarea, pre' ).addClass( 'radius2' );
		
		// Adicionando a classe .transition
		$( 'a, .sub-menu, .widget li' ).addClass( 'transition' );
		$( '.button, button, html input[type="button"], input[type="reset"], input[type="submit"]' ).addClass( 'transition' );
		
		// Ajuste de imagens nas postagens
		$( '.post-content img' ).addClass( 'shadow' );
		$( 'a:has( img )' ).addClass( 'img-link' );
		
		// Ajustes dos comentários
		$( '#comments .avatar' ).addClass( 'alignleft' );
		$( '.comment-body, .comment-content' ).addClass( 'inner' );
		$( '.comment-content' ).addClass( 'radius2' );
		$( '.reply' ).addClass( 'clear' );
		$( 'a.comment-reply-link' ).addClass( 'button' );
		
		// Ajustes dos ícones para os post-details
		$( '.post-categ > a' ).prepend( '<i class="fa fa-folder-open"></i> ' );
		$( '.post-author > a' ).prepend( '<i class="fa fa-user"></i> ' );
		$( '.post-date > time' ).prepend( '<i class="fa fa-clock-o"></i> ' );
		$( '.post-comments > a' ).prepend( '<i class="fa fa-comments"></i> ' );
		$( '.edit-link > a' ).prepend( '<i class="fa fa-pencil"></i> ' );
		
		// Ajustes para o lightbox
		var content_id = $( 'article.page, article.post' ).attr( 'id' );
		var link_img = $( '.page #principal .post-content a:has( img ), .single #principal .post-content a:has( img )' );
		
		link_img.attr( 'data-lightbox', content_id );
		
		link_img.each( function() {
			if ( $( this ).parent( 'figure' ) ) {
				var figure = $( this ).parent( 'figure' );
				var figcaption = figure.children( 'figcaption' ).text();
				var caption_txt = figcaption;
				
				figcaption.parent().children( 'a' ).attr( 'data-title', caption_txt );
			}
		} );
	} );

} )( jQuery );