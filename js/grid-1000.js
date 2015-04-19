/**
 * GRID FLEXÍVEL
 *
 * Ajustes para um grid flexível no tema.
 * ----------------------------------------------------------------------------
 */
var gridpak = {
	
	$container: {},
	
	append: '#grid > div.conteiner',	// Elemento DOM para anexar o Grid também
	
	css: '',
	
	/**
	 * Insere o jQuery, se ele já não estiver aí...
	 * 
	 * Checa o jQuery e o inclui via Google CDN se não
	 */
	bootstrap: function() {
		var jquerySrc = 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js',
			script = {},
			that = this;
		
		// Eles já trouxeram uma faca para tiroteio?
		if (typeof(window.jQuery) == 'undefined') {
			script = document.createElement('script');
			script.src= jquerySrc;
			// Insere logo após a tag de abertura <body>
			document.body.insertBefore(script, document.body.firstChild);
			setTimeout('gridpak.init()', 500);
		} else {
			$(function() { that.init(); });
		}
	},
	
	// Cria as colunas e configura as funções de redimensionamento
	init: function() {
		var gridOn = false,
			grids = [
				{
					min_width: 0,
					col_num: 2,
					gutter_type: '%',
					gutter_width: 3.2258,
					padding_type: '%',
					padding_width: 0,
					upper: 400
				},
				{
					min_width: 401,
					col_num: 6,
					gutter_type: '%',
					gutter_width: 2.8572,
					padding_type: '%',
					padding_width: 0,
					upper: 884
				},
				{
					min_width: 885,
					col_num: 12,
					gutter_type: '%',
					gutter_width: 2,
					padding_type: '%',
					padding_width: 0,
					upper: false
				},
			],
			numGrids = grids.length - 1,
			i = 0,
			markup = '';
		
		markup = '<div id="gridpak" style="display:none;" />';
		
		this.css += '<style type="text/css"> ' +
			'body { position:relative; }' +
			'#gridpak { ' +
				'width:100%; ' +
				'height:100%; ' +
				'display:block; ' +
				'position:absolute; ' +
				'top:0; ' +
				'left:0; ' +
			'} ' +
			'#gridpak .gridpak_grid { ' +
				'height:100%; ' +
				'display:none; ' +
			'} ' +
			'#gridpak .gridpak_col { ' +
				'border-left:0 solid rgba(255,255,255,0); ' +
				'border-right:0 solid rgba(255,255,255,0); ' +
				'-moz-background-clip: padding; -webkit-background-clip: padding-box; background-clip: padding-box;' +
				'padding:0; ' +
				'-webkit-box-sizing:border-box; -moz-box-sizing:border-box; box-sizing:border-box; ' +
				'display:block; ' +
				'float:left; ' +
				'height:100%; ' +
				'background-color:rgba(153,0,0,0.2); ' +
			
			'} ' +
			'#gridpak .gridpak_visible { ' +
				'width:100%; ' +
				'height:100%; ' +
				'display:block; ' +
				'background:rgba(255,255,255,0.3); ' +
			'} ';
		
		this.$container = $(markup);
		
		// Coloca a grade na tela
		for (i; i<=numGrids; i++) {
			gridpak.drawGrid(grids[i], i);
		}
		
		this.css += '</style>';
		$(this.append).prepend(this.css);
		
		this.toggleGrid();
		
		$(this.append).append(gridpak.$container);
		
	},
	
	/**
	 * drawGrid
	 * 
	 * Desenha uma grade única, geralmente chamada por um loop
	 */
	drawGrid: function(grid, num) {
		var markup = '',
			style = '',
			i = 1,
			gutter_pc = (grid.gutter_type == '%') ? grid.gutter_width : 0,
			gutter_px = (grid.gutter_type == 'px') ? grid.gutter_width : 0,
			width = 0;
		
		if (grid.gutter_type == 'px') {
			width = 100 / grid.col_num;
		} else {
			width = (100 - (gutter_pc * (grid.col_num - 1))) / grid.col_num;
		}
		
		markup = '<div class="gridpak_grid gridpak_grid_' + num + '">';
		
		this.css += '#gridpak .gridpak_grid_' + num + ' { ' +
			'margin-left:-' + gutter_px + 'px; ' +
		'} ' +
		'#gridpak .gridpak_grid_' + num + ' .gridpak_col { ' +
			'width:' + width + '%; ' +
			'margin-left:' + gutter_pc + '%; ' +
			'border-left-width:' + gutter_px + 'px; ' +
			'padding-left:' + grid.padding_width + grid.padding_type +'; ' +
			'padding-right:' + grid.padding_width + grid.padding_type + '; ' +
		'} ';
		if (grid.gutter_type == '%') {
			this.css += '#gridpak .gridpak_grid_' + num + ' .gridpak_col:first-child { ' +
				'margin-left:0;' +
			'} ';
		}
		
		this.css += '@media screen and (min-width: ' + grid.min_width + 'px) ';
		if (grid.upper != false) this.css += 'and (max-width: ' + grid.upper + 'px) ';
		this.css += ' { ' +
			'#gridpak .gridpak_grid_' + num + ' { ' +
				'display: block; ' +
			'} ' +
		'} ';
		
		for(i; i<=grid.col_num; i++) {
			markup += '<div class="gridpak_col"><div class="gridpak_visible"></div></div> <!-- // .gridpak_col -->';
		}
		
		markup += '</div><!-- // .gridpak_grid -->';
		
		gridpak.$container.append(markup);
	},
	
	//Alterna a visibilidade da grade com uma tecla
	toggleGrid: function() {
		var that = this;
		
		$(document).keyup(function(e) {
			if (e.keyCode == 71 && e.shiftKey) {
				that.$container.toggle();
				$('#grid').toggle();
			}
		});
	},
	
};


// Kick it off!
gridpak.bootstrap();