<?php
class Viking_Walker_Nav extends Walker {
	public $tree_type = array( 'post_type', 'taxonomy', 'custom' );
	public $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
	
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class=\"sub-menu\">\n";
	}
	
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "$indent</ul>\n";
	}
	
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		
		/**
		 * Filtro de classes
		 * Para remover os excessos de classes incorporadas ao elemento <li> dos menus
		 */
		// Adiciona ao filtro as classes customizadas por meio do painel de administração Aparência > Menus
		$filter_classes = empty( $filter_classes ) ? ( array ) get_post_meta( $item->ID, '_menu_item_classes', true ) : array();
		
		// Adiciona outras classes padrão que você deseja manter
		$filter_classes[] = 'current-menu-item';
		$filter_classes[] = 'menu-item';
		
		// Se não quiser usar o filtro de classes, comente essa linha
		$classes = is_array( $classes ) ? array_intersect( $classes, $filter_classes ) : '';
		
		// Adiciona a classe 'sub-menu-item' aos itens de sub-menus
		$classes[] = ($depth > 0) ? 'sub-menu-item' : '';
		
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		
		// Se quiser usar os atributos de 'id' no elemento <li>, remova os comentários dessas linhas
		//$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		//$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
		// Classe para os links
		$atts['class']  = ( $depth <= 0 ) ? 'menu-link' : 'sub-menu-link menu-link';
		
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		/** This filter is documented in wp-includes/post-template.php */
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}

}


    
    function start_el( &$output, $item, $depth, $args ) {
    	global $wp_query;
		
    	$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';
		
		$classes = empty( $item->classes ) ? array() : ( array ) $item->classes;
		
		/**
		 * Filtro de classes
		 * Para remover os excessos de classes incorporadas ao elemento <li> dos menus
		 */
		// Adiciona ao filtro as classes customizadas por meio do painel de administração Aparência > Menus
		$filter_classes = empty( $filter_classes ) ? ( array ) get_post_meta( $item->ID, '_menu_item_classes', true ) : array();
		
		// Adiciona outras classes padrão que você deseja manter
		$filter_classes[] = 'current-menu-item';
		$filter_classes[] = 'menu-item';
		
		// Se não quiser usar o filtro de classes, comente essa linha
		$classes = is_array( $classes ) ? array_intersect( $classes, $filter_classes ) : '';
		
		// Adiciona a classe 'sub-menu-item' aos itens de sub-menus
		$classes[] = ($depth > 0) ? 'sub-menu-item' : '';
		
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = strlen( trim( $class_names ) ) > 0 ? ' class="' . esc_attr( $class_names ) . '"' : '';
		
		// Se quiser usar os atributos de 'id' no elemento <li>, remova os comentários dessas linhas
		//$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		//$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		
        $output .= $indent . '<li' . $id . $value . $class_names .'>';
		
		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
		
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
		
		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		
		// Suporte ao elemento de descrição customizado por meio do painel de administração Aparência > Menus
		$description  = ! empty( $item->description ) ? '<br /><span class="menu-desc">'.esc_attr( $item->description ).'</span>' : '';
		
		if ( $depth != 0 ) {
            $description = $append = $prepend = "";
        }
		
		// Classe para os links
		$class_link = ($depth <= 0) ? 'menu-link' : 'sub-menu-link menu-link';
		
		$item_output = $args->before;
		$item_output .= '<a class="' . $class_link . '"' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $description; // Se quiser que a descrição fique em outra posição, altere a localização dessa linha
		$item_output .= $args->after;
		
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
?>