/**
 * imZoom
 * =============================================================================
 * charger les liens vers des images dans un diaporama
 * 
 * @author      Erwan Lefèvre <erwan.lefevre@gmail.com>
 * @copyright   Erwan Lefèvre 2009
 * @license     Creative Commons - Paternité 2.0 France - http://creativecommons.org/licenses/by/2.0/fr/
 * @version     3.2.1 / 2010-10-25
 * @see			http://www.webbricks.org/bricks/imZoom/
 
 * @compatible	au 25 octobre 2010, compatibilité assurée pour :
 *				Firefox, Internet Explorer 5.5+, Opéra, Safari, Chrome 
 */

/*global getKeyCode,preventDefault,css3,Anim,anim,window,addElem,addEvent,byId,byTN,getPos,pageDim,redimArea,remEvent,scrolled,setStyle,winDim */


/* exemples d'utilisation :
  
-	mettre en place sur un lien :

		var target = document.getElementById('target');
		imZoom.applyTo(target);
  
-	mettre en place sur une liste de liens :

		var targets = document.getElementById('container').getElementsByTagName('a');
		imZoom.applyTo(targets); //  comme pour un seul lien
  
-	mettre en place sur tous les liens éligibles de la page :

		imZoom.autoApplyInto();
  
-	mettre en place sur tous les liens éligibles d'un élément donné :

		var container = document.getElementById('container');
		imZoom.autoApplyInto(container);
		
-	pour passer des options :

	-	avec imZoom.applyTo() :
		
		var options = {
			opt1 : val1,
			optn : valn
		}
		imZoom.applyTo(target, options); (options en second paramètre)

	-	avec imZoom.autoApplyInto() :
		
		var options = {
			opt1 : val1,
			optn : valn
		}
		imZoom.autoApplyInto(options, container); (options en premier paramètre)

*/





var imZoom = (function (window, document, undefined) {

/**
 * transfer
 * =============================================================================
 * retourne un objet contenant les propriétés et méthodes de l'objet /dest/,
 * complétées et/ou écrasées par celles de l'objet /source/
 *
 * @param       source       {object}        l'objet source
 * @param       dest         {object}        l'objet de destination
 * @return      {object}
 *
 */
function transfer (source, dest) {
    var prop, transfered={};
    for ( prop in dest ) { transfered[prop] = dest[prop]; }
    for ( prop in source ) { transfered[prop] = source[prop]; }
    return transfered; 
}





/**
 * easeInOut v1.1 / 2010-06-26
 * 
 * calcule des étapes d'animation douces
 *
 * @param       startValue      {Float}          valeur de départ (peut être inférieure à celle de fin)
 * @param       endValue        {Float}          valeur de fin (peut être supérieure à celle de fin)
 * @param       totalSteps      {Integer}        nombre total d'étapes dans l'animation
 * @param       actualStep      {Integer}        étapes actuelle de l'animation
 * @param       powr            {Float}          "puissance" de la courbe. 1=linéaire et ease-out<1<ease-in. (0.2 et 3 font de belles courbes)
 * @param       round           {Integer}        indique d'arrondir le résultat ou non
 * 
 * @returns     {mixed}         Integer|Float selon la valeur du paramètre round
 * 
 * =============================================================================
 */
function easeInOut(startValue,endValue,totalSteps,actualStep,powr,round) { 
    var stepp, delta = endValue - startValue; 
    stepp = startValue+(Math.pow(((1 / totalSteps) * actualStep), powr) * delta); 

    return round ? Math.round(stepp) : stepp;
}





/**
 * each()  v1.2.1 - 2010-10-12
 * =============================================================================
 * extensions de l'objet Object, permettant de parcourir son contenu

 * @param		{function}		fn				obligatoire - fonction callBack à appliquer à chaque élément de l'objet
 * @param		{boolean}		recursive		facultatif - la valeur cherchée pour l'attibut. accepte une chaine ou une expression régulière; par défaut : toutes
 *
 * @return      Object			retourne l'objet initial
 *
 */
Object.prototype.each = function (fn, recursive) {
	
	for (var key in this) {
		if (this.hasOwnProperty(key)) {
			if (recursive && typeof this[key] === 'object') {
				this[key].each(fn);
			}
			else {
				fn.apply(
					this,
					[ this[key], key ]
				);
			}
		}
	}
	
	return this;
};






/** 
 * winDim v2.0.1, 2010-07-07
 * 
 * retourne les dimentions intérieurs de la fenêtre
 *
 * @returns		{Object}
 * 
 * =============================================================================
 */
function winDim() {
	var w,h,
		i = window,
		d = document,
		de = d.documentElement,
		db = d.body;
		
	if ( i.innerWidth ) { // autres que IE
		w = i.innerWidth;
		h = i.innerHeight;
	} else if ( de.clientWidth ) { // IE8
		w = de.clientWidth;
		h = de.clientHeight;
	}
	else { // IE6
		w = db.clientWidth;
		h = db.clientHeight;
	}

	return {'w':w, 'h':h} ;
}






/** 
 * setStyle v1.0
 * 
 * Modifie l'attribut style de l'élément /element/, selon le tableau associatif /styles/.
 *
 * @param           elem            {HTMLElement}           l'élément dont on veut modifier les styles
 * @param           styles          {Object}                définition (javascript) des styles à appliquer à l'élément
 * @returns         {void}
 * 
 * =============================================================================
 */
function setStyle(elem, styles) { // 58 octets
	for (var prop in styles) {
		elem.style[prop] = styles[prop];
	}
}




/** scrolled
 * =============================================================================
 * retoune les valeurs (horizontale et verticale) de défilement de la fenêtre
 * (en tenant compte du navigateur)
 *
 * @return          Object      {'x','y'}         
 */
function scrolled () {
    var x,y,
		w = window,
		d = document,
		de = d.documentElement,
		db = d.body;
    
    // vrais navigateurs
    if ( w.pageXOffset!==undefined) {
        x = w.pageXOffset;
        y = w.pageYOffset;
    }
    // ie
    else {
        x = de.scrollLeft ? de.scrollLeft : (db.scrollLeft?db.scrollLeft:0) ;
        y = de.scrollTop ? de.scrollTop : (db.scrollTop?db.scrollTop:0) ;
    }
    
    return {'x':x, 'y':y};
}






/**
 * remEvent()
 * 
 * retire la fonction /fn/ de la pile de résolution de l'événement /evenType/ de
 * l'objet /obj/
 * 
 * merci à : http://www.scottandrew.com/weblog/articles/cbs-events
 * 
 * @param		{Mixed}				obj			window, ou document, ou un élément HTML
 * @param		{string}			evType		type d'event (click, mouseover, mouseout, etc.…)
 * @param		{string}			fn			la fonction à supprimer
 * @param		{boolean}			useCapture	
 * 
 * @returns		void
 * 
 * =============================================================================
 */
function remEvent(obj, evType, fn, useCapture){
	if (obj.removeEventListener) { obj.removeEventListener(evType, fn, useCapture); }
	else { obj.detachEvent("on"+evType, fn); }
}




/**
 * redimArea v1.2 / 2010-06-26
 * 
 * retourne les mesures /{w,h}/ de /src_w/ et /scr_h/, après redimentionnement homotétique
 * d'après les critères /mesures{max_w, min_w, max_h, max_h}/
 *
 * @param		{Integer}		src_w		largeur de la surface à redimentionner
 * @param		{Integer}		src_h		hauteur de la surface à redimentionner
 * @param		{Object}		mesures		mesures maximales et/ou minimales pour
 *											la largeur et/ou la hauteur
 *
 * @returns		{Object}
 *											
 * =============================================================================
 */
function redimArea (src_w, src_h, options) {
	
	// initialisations
	
		var max_w, min_w, max_h, min_h, // contraintes données en options
			round,						// option indiquant d'arrondir les dimensions obtenues
			wh, hw,						// rapports de proportion de la surface
			height, width;				// dimensions finales de la surface
		
		// mesures souhaitées
		options = options || {};
		max_w = options.max_w;
		min_w = options.min_w;
		max_h = options.max_h;
		min_h = options.max_h;
		
		// autres options
		round = options.round===undefined ? 1 : options.round; // pour rétrocompatibilité : undefined=>true
	
		// calcul du rapport largeur/hauteur de la source
		wh = src_w / src_h ;
		hw = src_h / src_w ;
		
		// par défaut, garder les mesures initiales
		height = src_h ;
		width = src_w ;
		
	// redimentionnements
		
		// agrandissement largeur
		if ( width < min_w ) {
			width = min_w;
			height = width * hw ;
		}
		
		// agrandissement hauteur
		if ( height < min_h ) {
			height = min_h;
			width = height * wh ;
		}
	
		// réduction largeur
		if ( max_w && (width > max_w) ) {
			width = max_w;
			height = width * hw ;
		}
	
		// réduction hauteur
		if ( max_h && (height > max_h) ) {
			height = max_h;
			width = height * wh ;
		}
		
	// valeurs négatives interdites
		width = width<0 ? 0 : width;
		height = height<0 ? 0 : height;
	
	return {
		w : round ? Math.round(width) : width,
		h : round ? Math.round(height) : height
	};
}





/**
 * preventDefault()
 * 
 * permet d'annuler l'effet normal d'un événement sur un élément html
 * (revient à faire un "return false" pour cet événement, en passant par le event-handeler)
 *
 * v1.0 - 2010-05-30
 * 
 * @returns		void
 * 
 * =============================================================================
 */
function preventDefault(e){
	e = e||event;
	if (e.preventDefault) { e.preventDefault(); }
	else { e.returnValue = false;  }
}



/** 
 * pageDim() 
 * -----------------------------------------------------------------------------
 * retourne les dimentions de la page
 *
 * @return		{Object}		{'w','h'}
 */
function pageDim() {
	var d = document,
		dE = d.documentElement,
		dB = d.body,
		w, h;
		
	// firefox is ok
	h = dE.scrollHeight;
	w = dE.scrollWidth;
	
	// now IE 7 + Opera with "min window"
	if ( dE.clientHeight > h ) { h  = dE.clientHeight; }
	if ( dE.clientWidth > w ) { w  = dE.clientWidth; }
	
	// last for safari
	if ( dB.scrollHeight > h ) { h = dB.scrollHeight; }
	if ( dB.scrollWidth > w ) { w = dB.scrollWidth; }

	return {'w':w, 'h':h} ;
}






/** 
 * getPos v1.01
 * 
 * retourne la position (dans la page) de chacun des côtés de l'élément /elem/,
 * dispatché dans un tableau associatif contenant les clés t|b|l|r
 * (la valeur retournée est donnée en pixels)
 * (tient compte des différences de fonctionnement des navigateur)
 *
 * @param           Object          elem            l'élément inspecté
 * 
 * @returns         Integer
 * 
 * =============================================================================
 */
function getPos(elem) {
    var pos={'r':0,'l':0,'t':0,'b':0},
        tmp=elem;
    
    // on procède de parent en parent car IE fonctionne comme ça
    // (les autres donnent directement la position par rapport à la page)
    
    do {
        pos.l += tmp.offsetLeft;
        tmp = tmp.offsetParent;
    } while( tmp !== null );
    pos.r = pos.l + elem.offsetWidth;
    
    tmp=elem;
    do {
        pos.t += tmp.offsetTop;
        tmp = tmp.offsetParent;
    } while( tmp !== null );
    pos.b = pos.t + elem.offsetHeight;
    
    return pos;
}





/** 
 * getKeyCode v1.2 / 2010-06-26
 * 
 * retourne le code de la touche pressée, pour l'event /e/.
 *
 * @requires	addEvent
 * 
 * @param		event		e		l'événement courant
 * 
 * @returns		{Integer}
 *
 * =============================================================================
 */
function getKeyCode(e) {
	e = e||event;
	keyCode = e.which || e.keyCode;
	return keyCode;
}




/**
 * Css3 v1.0 / 2010-10-14
 * =============================================================================
 * créée un objet Css3
 *
 * @param		elem		{HTMLElement}		L'élément auquel appliquer des propriétés css3
 */
function Css3(elem){
	
	var self = this;
	
	this.elem = elem;
	
	/**
	 * extend
	 * -------------------------------------------------------------------------
	 * permet d'ajouter des modules à Css3, de façon manuelle ou automatisée
	 *
	 * @param		fnName		{Mixed}			nom de la méthode à ajouter {String}
	 *											dans le cas d'un ajout automatisé, plusieurs noms de méthodes
	 *											peuvent être donnés, séparés par des espaces {String},
	 *											ou dispatchés dans un tableau {Array}
	 * @param		fn			{Mixed}			facultatif - méthode à ajouer {Function}
	 *											si non fourni, la méthode est crée de façon automatique {undefined}
	 *
	 * @returns		{this}
	 *
	 */
	this.extend = function(fnName, fn){
		if ( fnName ) {
			if (!fn) {
				var i, max, propList, tmp;
				propList = fnName instanceof Array ? fnName : fnName.split(" ");
				for ( i = 0, max = propList.length; i < max ; i++) {
					fnName = propList[i];
					tmp = new Function("val", "css3(this.elem).auto('"+fnName+"', val); return this;");
					self.extend(fnName, tmp);
				}
			}
			else {
				Css3.prototype[fnName] = fn;
			}
		}
		return this;
	};
	
	/**
	 * auto
	 * -------------------------------------------------------------------------
	 * permet d'émuler un certain nombre de propriétés css3, en apposant simplement
	 * au non de la propriété les préfixes des différents navigateurs
	 *
	 * @param		fnName		{String}		nom de la méthode à ajouter
	 * @param		fn			{Function}		méthode à ajouter
	 *
	 * @returns		{this}
	 *
	 */
	this.auto = function(propName, value){

		var elem = self.elem;

		// conversion des syntaxes css en syntaxes js (boderWidth vient doubler border-width)
		if ( /-/.test(propName) ) {
			propName = propName.css2js();
		}
		
		// pour les navigateur supportant la réellement la propriété css3
		elem.style[propName] = value;
		
		// pour les alternatives propriétaires
		propName = propName.substring(0,1).toUpperCase() + propName.substring(1); // propName[0] n'est pas compatible ie<8
		elem.style["O"+propName] = value;
		elem.style["Moz"+propName] = value;
		elem.style["Webkit"+propName] = value;
		elem.style["Khtml"+propName] = value;
		
		return this;
	};
	
	
	/**
	 * isset
	 * -------------------------------------------------------------------------
	 * Retourne vrai si une méthode du nom fnName a été créée dans l'objet Css3.
	 * Sinon faux.
	 *
	 * @param		propList		{Array}		noms des modules à générer
	 *
	 * @returns		{this}
	 *
	 */
	this.isset = function (fnName){
		return Css3.prototype[fnName];
	};
}


/**
 * css3 (sans majuscule)
 * -----------------------------------------------------------------------------
 * raccourci, retournant un objet Css3
 *
 * @returns		{Css3 Object}
 */
function css3(elem){
	return new Css3(elem);
}



/**
 * Css3.opacity
 * =============================================================================
 * règle l'opacité d'un élément
 *
 * @param       elem            {HTMLElement}		l'élément à traiter
 * @param       value           {Float}				valeur souhaitée (0=transparent, 1=opaque)
 * 
 * @return      {this}
 */
css3().extend('opacity', function (value) {
	var self = this; // pour gagner quelques octets
	value = (value == 1) ? 0.99999:value;

	// ie
	self.elem.style.zoom = 1; // obtenir le layout
	self.elem.style.filter = 'alpha(opacity=' + value * 100 + ')';
	
	// autres navigateurs
	self.auto('opacity', value);
	
	return self;
});






/**
 * byTN()
 * 
 * raccourci pour [element].getElementsByTagName()
 * retourne l'élément html de type /tagName/
 *
 * @param		tagName		{String}		Le type d'éléments recherché
 *
 * @returns		{HTMLCollection}
 * 
 * =============================================================================
 */
function byTN(tagName,container) {
	return (container||document).getElementsByTagName(tagName) ;
}








/**
 * byId()
 * raccourci pour document.getElementById()
 * retourne l'élément html dont l'attribut id vaut /id/
 *
 * @param		id		{String}		L'attribut id de l'élément recherché
 *
 * @returns		{HTMLElement}
 * 
 * =============================================================================
 */
function byId(id) {
	return document.getElementById(id) ;
}







/**
 * addEvent
 * 
 * ajoute la fonction /fn/ à la pile de résolution de l'événement /evenType/ de
 * l'objet /obj/
 * 
 * merci à : http://www.scottandrew.com/weblog/articles/cbs-events
 *
 * @param		{Mixed}				obj			window, ou document, ou un élément HTML
 * @param		{String}			evType		type d'event (click, mouseover, mouseout, etc.…)
 * @param		{String}			fn			la fonction à ajouter
 * @param		{Boolean}			useCapture	"useCapture un booléen
 * 
 * @returns		void
 * 
 * =============================================================================
 */
function addEvent (obj, evType, fn, useCapture){
	if (obj.addEventListener) { obj.addEventListener(evType, fn, useCapture); }
	else { obj.attachEvent("on"+evType, fn); }
}





/**
 * addElem v1.01
 * raccourci pour [HTMLElement].appendChild(document.createElement([tagName]))
 * 
 * @param		{HTMLElement}		container		(optionnel) l'élément dans lequel en créer un nouveau (par défaut :  <body>)
 * @param		{string}			tagName			le type d'élement à créer (div|p|a|table, etc.)
 *
 * @returns		{HTMLElement}
 * 
 * =============================================================================
 */
function addElem(tagName,container){
	container = container || document.getElementsByTagName("body")[0]; 
	return container.appendChild(document.createElement(tagName));
}



/**
 * Anim v1.1.1 / 2010-10-24
 * 
 * permet d'animer des éléments HTML au moyen de leurs propriétés de styles
 *
 * @requires    transfer	
 * @requires    easeInOut
 * @requires    Object.each
 * @requires    css3				(uniquement pour la compatibilité des propriétés css3)
 * @requires    css3.opacity		(uniquement pour la compatibilité de la propriété 'opacity')
 * @requires    Color				(uniquement pour les animation de couleurs)
 * @requires    getPos				(uniquement pour détecter automatiquement la position d'un élément dans la page)
 * 
 * @param       elem			{HTMLElement}		l'élément à animer
 * @param       defSettings		{Object}			facultatif - les réglages qui serviront par défaut (voir détail dans le code source, à la déclaration de self.def)
 *
 * =============================================================================
 */
function Anim(elem, defSettings){
	
	var self = this; // surtout pour jsMin
	
    // options par défaut
    self.def = { 
        from : {}, // Object - propriétés de style initiales - exemple : {width:'300px', color:'#faa'}
        to : {}, // Object - propriétés de style finales - exemple : {fontSize:'2em', backgroundColor:'rgb(200,55,0)'}
        restart : 1, // Boolean - si l'animation vient à âtre relancée avant la fin, faut-il la reprendre à zéro
        ease : 1, // Float - régularité de l'anim. 1=linéaire, et ease-out<1<ease-in
        duration : 500, // Integer - durée de l'animation (en millisecondes)
		onStart : 0, // Function - une fonction callback à exécuter au début de l'animation
		onNewFrame : 0, // Function - une fonction callback à exécuter à chaque étape de l'animation
		onFinish : 0 // Function - une fonction callback à exécuter à la fin de l'animation
    };
	
    // lecture de l'élément courant
    self.elem = elem;
	
    // chargement des options
    self.def = transfer(defSettings||{}, self.def);
    
    
	
    /**
     * setDef
     * 
     * détermine les paramètres par défaut de l'animation courante
     *
     * @param           {Object}		settings		les paramètres par défaut à attribuer à l'animation courante
     * @return			{self}
     * 
     * -------------------------------------------------------------------------
     */
    self.setDef = function (settings) {
		self.def = transfer(settings, self.def);
		return self;
	};
    
    
	
    /**
     * detectProp
     * 
     * tente de déterminer la valeur actuelle de la propriété /prop/
     *
     * @param           {String}		prop		le nom de la propriété de style - exemple : 'backgroundColor'
     * @return			{Mixed}
     * 
     * -------------------------------------------------------------------------
     */
    self.detectProp = function (prop) {
		var elem = self.elem,
			getPos = window.getPos,
			px = 'px', zpx = '0px'; // pour jsMin
        switch (prop) {
                case 'width': return elem.clientWidth+px;
                case 'height': return elem.clientHeight+px;
					
				// ont recours à d'autres scripts
                case 'top':		return getPos ? getPos(elem).t+px : zpx ; 
                case 'bottom':	return getPos ? getPos(elem).b+px : zpx ; 
                case 'left':	return getPos ? getPos(elem).l+px : zpx ; 
                case 'right':	return getPos ? getPos(elem).r+px : zpx ; 
                        
                /* valeurs fermes, établies d'après les valeurs par défaut des principaux navigateurs
                case 'borderColor': return 'rgb(0,0,0)';
                case 'backgroundColor': return 'rgb(255,255,255)';
                case 'color': return 'rgb(0,0,0)';
                case 'borderWidth': return '1px';
                case 'opacity': return 1;
                */
                
                default : return 0;
        }
        return false;
    };
    
    
    
    /**
     * readProp
     * 
     * décompose la valeur d'une propriété de style donnée, et retourne le résultat
     * dans un tableau associatif contenant (selon pertinence) la valeur soumise (.asked),
     * les unités de mesure (.unit), la valeur numérique sans unités (.clean),
     * et un tableau décomposant les valeurs rvb de coloration
     *
     * @param           propValue			{String}		la valeur de la propriété à décomposer
     * 
     * @return          {Array}				retourne un tableau associatif contenant une série d'interprétations de la valeur donnée
     * 
     * -------------------------------------------------------------------------
     */
    self.readProp = function (propValue) {
		var decomposed = {},
			asked,
			color;
		
		asked = decomposed.asked = propValue+''; // rappel de la valeur soumise
		decomposed.unit = asked.match(/px|em|%/); // unités
		
		decomposed.clean = parseFloat(asked); // valeur numérique (çàd sans les unités)           
		// gestion des couleurs (seulement si les fonction spécifiques ont été déclarées)
		if ( window.Color && asked.match(/rgb|(#[a-f0-9]{3,6})/i) ) {
			decomposed.clean = asked; // pour l'initialisation
			color = new Color(asked);
			decomposed.rgb = color.rgbArr();
		}
		return decomposed;    
	};
	
	
	
	/**
     * readFromTo
     * 
     * décompose les différentes propriétés listées dans options.from et options.to
     * (soumettre l'une ou l'autre de ces variables comme paramètre de la fonction)
     *
     * @param           set				{Mixed}			les options .to ou .from de l'animation.
     *													accepte de préférence un tableau associatif,
     *													mais peut traiter des chaines proprement rédigée
     * @return          {Object}		retourne un tableau associatif décomposant,
     *									pour chaque propriété déclarée, des mesures
     *									et intéprétations (cf. self.readProp())
     * 
     * -------------------------------------------------------------------------
     */
    self.readFromTo = function (set) {
        
        if (!set) {return false;}
		var prop, eachDeclared={},
			declared, i, lg, tmp; // pour traiter les déclarations abrégées
		
		// décomposition des déclarations abrégées
		if ( set instanceof String ) {
			
			// conversion de la syntaxe css en syntaxe js (border-width devient boderWidth)
			if ( set.css2js ) {
				set = set.css2js();
			}
			
			// relevé des différentes propriétés déclarées dans la chaîne
				set = set.trim();
				declared = set.split(/;/);
				declared.each(function(v,k){ // supprimer les lignes vides
					if (!v) {
						declared.splice(k,1);
					}
				});
				lg = declared.length;
			
			// recomposition de la déclaration sous forme d'objet
				set = {};
				for (i=0; i<lg; i++) {
					tmp = declared[i].split(/:/);
					prop = tmp[0].trim(); // propriété concernée
					set[prop] = tmp[1].trim() ;
				}
		}
		
		// traitement de chacune des propriétés
		set.each(function(propVal,propName){
			eachDeclared[propName] = self.readProp(propVal+'');
		});
		
        return eachDeclared;
    };
    
	
    
    /**
     * go
     * 
     * lance l'animation, avec les options /options/
     *
     * @param       options          {Object}       les options pour cette occurence de l'animation
     * 
     * -------------------------------------------------------------------------
     */
    self.go = function (options) {

        var opt, // raccourci pour self.options
			prop, // pour boucle for in
			st; // raccourci pour self.elem.style
        
        // chargement des réglages
		opt = self.options = transfer(options||{}, self.def);

		// callback de début d'anim
		if ( opt.onStart ) {
			opt.onStart();
		}

		// intialisation du compteur de temps
        if ( opt.restart || !self.startTime ) {
			self.startTime = new Date().getTime();
			self.pauseTime = 0;
		}
		
        // décompostions des propriétés de from et to
        self.from = self.readFromTo( opt.from ? opt.from : self.def.from );
        self.to = self.readFromTo( opt.to ? opt.to : self.def.to );

        
        // compléter les from manquants...
        st = elem.style;
        for (prop in self.to) {
			if ( !self.from[prop] ){
				if ( st[prop] || st[prop]===0 ) { // ...par la propriété  de style si déjà définie par js
					self.from[prop] = self.readProp(st[prop]);
				}
				if ( !self.from[prop] ) { // ...sinon tâcher de détecter la valeur courante
					self.from[prop] = self.readProp(self.detectProp(prop));
				}
			}
		}
		   
        // initialiser l'élément animé, tel que déclaré dans .from
		self.from.each(function(propName, propVal){
			st[propName] = propVal.clean;
		});
        
        // lancer le premier frame
        self.next() ;
		
		return self;
    };
	
	
        
    /**
     * next
     * 
     * lance le frame suivant
     * 
     * -------------------------------------------------------------------------
     */
    self.next = function () {
		self.prog = setTimeout(self.frame, 1);
		if ( self.pauseStart ) {
			var t = new Date().getTime();
			self.pauseTime += t - self.pauseStart;
			self.pauseStart = 0;
		}
		return self;
	};
	
	
        
    /**
     * pause
     * 
     * suspend l'animation
     * 
     * -------------------------------------------------------------------------
     */
    self.pause = function () {
		clearTimeout(self.prog);
		self.pauseStart = new Date().getTime();
		return self;
	};
	    
      
	    
    /**
     * frame
     * 
     * exécution d'une étape de l'animation
     * 
     * -------------------------------------------------------------------------
     */
    self.frame = function () {
        // raccourcis
        var opt = self.options, // raccourci
			duration, ease, // raccourcis pour options.duration et options.ease
			newVal,
			st, // raccourci pour les styles de l'élément à modifier
			coulTo, coulFrom, r, g, b, // pour la manipulation des couleurs
			t, animTime, // compteurs de temps
			fromProp; // raccourci pour les noms de propriétés de from
			
		st = elem.style;
			
		// calculs du temps écoulé
		t = new Date();
		t = t.getTime();
		animTime = t - self.startTime - (self.pauseTime||0);
		
		// callback appliquée à chaque frame
		if ( opt.onNewFrame ) {
			opt.onNewFrame();
		}
        
        // si anim terminée
        if ( animTime >= opt.duration ) {
			self.to.each(function(propVal, propName){
				st[propName] = propVal.asked;
				if ( window.Css3 && css3().isset(propName) ) {
					css3(self.elem)[propName](propVal.asked);
				} 
			});
			if ( opt.onFinish) {
				opt.onFinish(); // fonction callback
			}
			self.startTime = 0;
			self.pauseTime = 0;
        }
        
        // sinon éxécuter le frame courant
        else {
			self.to.each(function(propVal,propName){
				fromProp = self.from[propName];
				duration = opt.duration;
				ease = opt.ease;
				// gestion propriétés de coloration
                if (propVal.rgb) {
                    coulTo = propVal.rgb;
                    coulFrom = fromProp.rgb;
                    r = easeInOut(parseInt(coulFrom[0],10), parseInt(coulTo[0],10), duration, animTime, ease);
                    g = easeInOut(parseInt(coulFrom[1],10), parseInt(coulTo[1],10), duration, animTime, ease);
                    b = easeInOut(parseInt(coulFrom[2],10), parseInt(coulTo[2],10), duration, animTime, ease);
                    st[propName] = 'rgb('+Math.round(r)+','+Math.round(g)+','+Math.round(b)+')';
                }
				// gestion des autres types de propriétés
                else {
					newVal = easeInOut(fromProp.clean, propVal.clean, duration, animTime, ease);
					if (self.to[propName].unit==='px') {
						newVal = parseInt(newVal,10);
					}
					st[propName] = newVal + self.to[propName].unit;
					
					// traitement crossbrowser des propriétés css3
                    if ( window.Css3 && css3().isset(propName) ) {
						css3(self.elem)[propName](newVal);
					} 
				}
			});
            self.next();
        }
		
    };
	
}





/**
 * anim (sans majuscule)
 * -----------------------------------------------------------------------------
 * raccourci, retournant un objet Anim
 *
 * @param		voir Anim()
 *
 * @returns		{Anim Object}
 */
function anim(elem, defSettings){
	return new Anim(elem, defSettings);
}



/**
 * imZoom - v3.2.1, 2010-10-25
 * =============================================================================
 * charger les liens vers des images dans un diaporama
 * 
 * @uses		anim
 * @uses		addElem
 * @uses		addEvent
 * @uses		byId
 * @uses		byTN
 * @uses		getPos
 * @uses		getKeyCode
 * @uses		pageDim
 * @uses		preventDefault
 * @uses		redimArea
 * @uses		remEvent
 * @uses		setStyle
 * @uses		scrolled
 * @uses		winDim
 * @uses		Object.each
 */		
var imZoom = {  
	
	/**
	 * gal
	 * -------------------------------------------------------------------------
	 * liste de lien à traiter dans le diaporama
	 */
	gal : [], 
	
	/**
	 * defaultOpt
	 * -------------------------------------------------------------------------
	 * tableau associatif des options par défaut
	 */
	defaultOpt : {
		screenColor : '#fff',           // couleur du fond
		screenOpacity : 0.6,            // opacité du fond
		zIndex : 1000,					// propriété css zIndex appliquée aux éléments de imZoom
		anim : 1,						// indique d'enchaîner par animations ou non
		animDuration : 1000,             // durée des animations d'ouverture et de changement (fadeout+fadein) (en millisecondes)
		animEase : 2,                   // effet d'animation : 1=linéaire, ease-out<1<ease-in
		//onOpen : 0,					// fonction callback, à l'ouveture (à la fin de l'animation)
		//onChange : 0,					// fonction callback, au changement d'image (à la fin de l'animation)
		//onClose : 0,					// fonction callback, à la fermeture
		showNav : 1,					// indique d'afficher ou non la barre de navigation
		showTitle : 1,					// indique d'afficher ou non le titre du lien
		prevTxt : '&lt;&lt;',			// texte pour le bouton "prev"
		nextTxt : '&gt;&gt;',			// texte pour le bouton "next"
		playTxt : 'diaporama',			// texte pour le bouton "play"
		pauseTxt : 'pause',				// texte pour le bouton "pause"
		slideDelay : 4000,				// temporisation entre deux images dans le diaporama (en millisecondes)
		//autoPlay : 0,					// indique de lancer ou non un diaporama dès l'ouverture
		preloaderUrl : 'loading.gif',   // url de l'image indiquant un chargement en cours
		maxSize : 1                     // indique s'il on restreint l'agrandissement de l'image (à ses mesures normales)
	},
	
	/**
	 * applyTo()
	 * -------------------------------------------------------------------------
	 * applique l'effet à un élément ou une liste d'éléments (sans vérifier leur éligibilité)
	 *
	 * @param		mixed		actionners		un élement html (ou un liste d'éléments html) sur lequel mettre en place l'effet
	 * @param		object		options			(facultatif) les options à appliquer pour cet (ou ces) élément(s)
	 */
	applyTo : function (actionners, options) {
		if (!actionners.length) {
			actionners = [actionners];
		}
		this.gal = actionners;
		var actNb = actionners.length,
			i,
			go = function () {
				imZoom.go(this, options);
				return false;
			};
		for (i = 0; i < actNb; i++) {
			actionners[i].onclick = go;
		}
	},  
	
	/**
	 * autoApplyInto()
	 * -------------------------------------------------------------------------
	 * tente de mettre en place l'effet sur tous les liens éligibles à l'intérieur de la page ou d'un élément donné
	 *
	 * @param		object			options			(facultatif) les options à appliquer pour cet élément
	 * @param		htmlElement		container		(facultatif) l'élement au sein duquel on cherchera des liens éligible pour leur appliquer l'effet. (par défaut : document)
	 */
	autoApplyInto : function (options, container) {
		var liens = byTN('a', container),
			nbLiens = liens.length,
			i, n = 0,
			list = [];
		for (i = 0; i < nbLiens; i++) {
			if (/\.(jpe?g|gif|png|tiff?)/i.test(liens[i].href)) {
				list[n] = liens[i];
				n++;
			}
		}
		imZoom.applyTo(list, options); 
	}, 
	
	/**
	 * keyNav()
	 * -------------------------------------------------------------------------
	 * navigation au clavier
	 * ne fonctionne pas sous ie !!!
	 */
	keyNav : function (e) {
		var prevent,
			keyCode = getKeyCode(e),
			iz = imZoom;
			
			
		switch (keyCode) {
		case 37 : // gauche
			iz.prev();
			prevent = 1;
			break; 
		case 13 : // entrée 
		case 39 : // droite
			iz.next();
			prevent = 1;
			break; 
		case 27 : // escape
			iz.close();
			prevent = 1;
			break; 
		case 32 : // espace
			if (iz.prog) {
				iz.pause();
			}
			else {
				iz.play();
			}
			prevent = 1; 
			break; 
		}
		if (prevent) {
			preventDefault(e);
		}
	}, 
	
	/**
	 * goTo()
	 * -------------------------------------------------------------------------
	 * lancer le chargement d'une des images, désignée par son numéro
	 * les numéros trop grands renvoient à la dernière image
	 * les numéros trop petits renvoient à la première image
	 *
	 * @param		integer			n			(facultatif) le numéro de l'image à charger (par défaut : la suivante)
	 */
	goTo : function (n) {
		var iz = this;
		iz.cancelLoading();
		n = n > iz.gal.length - 1 ? 0 : (n < 0 ? iz.gal.length - 1 : n); // boucler en cas de dépassement du nb d'images
		iz.active = n;
		iz.go(iz.gal[n]);
	}, 
	
	/**
	 * prev()
	 * -------------------------------------------------------------------------
	 * lancer le chargement de l'image précédente
	 */
	prev : function () {
		imZoom.goTo(imZoom.active - 1);
	}, 
	
	/**
	 * next()
	 * -------------------------------------------------------------------------
	 * lancer le chargement de l'image suivante
	 */
	next : function () {
		imZoom.goTo(imZoom.active + 1);
	}, 
	
	/**
	 * progImg()
	 * -------------------------------------------------------------------------
	 * programme le chargement d'une image
	 *
	 * @param		integer			imgNb			(facultatif) le numéro de l'image à charger (par défaut : la suivante)
	 */
	progImg : function (imgNb) {
		var iz = imZoom;
		imgNb = imgNb === undefined ? iz.active + 1 : imgNb;
		iz.prog = setTimeout(
			function () {
				iz.goTo(imgNb);
			},
			iz.options.slideDelay
		);
	},
	
	/**
	 * play()
	 * -------------------------------------------------------------------------
	 * lance un diaporama, à partir de l'image active
	 */
	play : function () {
		if (!imZoom.prog) {
			this.progImg();
			byId('izPlay').style.display = 'none';
			byId('izPause').style.display = '';
		}
	},
	
	/**
	 * pause()
	 * -------------------------------------------------------------------------
	 * interromp le diaporama
	 */
	pause : function () {
		clearTimeout(imZoom.prog);
		imZoom.prog = 0;
		byId('izPause').style.display = 'none';
		byId('izPlay').style.display = '';
	},
	
	/**
	 * callback()
	 * -------------------------------------------------------------------------
	 * appelle une des fonctions callback passées en options
	 */
	callback : function (functionName) {
		var func = imZoom.options[functionName];
		if (func && byId('izImg')) {
			func();
		}
	},
	
	/**
	 * change()
	 * -------------------------------------------------------------------------
	 * lance l'animation de changement d'image
	 */
	change : function () {
		
		var iz = imZoom,
			ani;
			
		ani = iz.options.anim;
		
		function onAppear() {
			iz.callback('onChange');
			if (iz.prog) {
				clearTimeout(iz.prog);
				iz.prog = 0;
				iz.progImg();
			}
		}
		
		function onDisappear() {
			var img = byId('izImg');
			if (img) { // une condition (pour l'anim), des fois qu'on ait fermé imZoom entre temps
				img.onload = function () {
					setTimeout( // Google Chrome me contraint à faire un timeout
						function(){
							iz.setPos(); // pour ajuster la barre de nav à l'image
							var izTitle = byId('izTitle');
							if (izTitle && iz.options.showTitle) {
								izTitle.innerHTML = iz.gal[iz.active].title;
							}
							
							if (ani) {
								iz.animGlob.go({
									to: {opacity: 1},
									onFinish: onAppear
								});
							}
							else {
								onAppear();
							}
						},
						1
					);
					
				};
						
				// changer l'image source
				img.src = iz.gal[iz.active].href;
			}
		}
		
		if (ani) {
			iz.animGlob.go({
				to: {opacity: 0}, // disparition en fondu
				onFinish: onDisappear // puis changement d'image, et réapparition
			});
		}
		else {
			onDisappear();
		}
		
	},
	
	/**
	 * go()
	 * -------------------------------------------------------------------------
	 * charge l'image voulue, après avoir ouvert imZoom s'il ne l'était déjà
	 */
	go : function (actionner, options) {
		
		var iz = this,
			i = 0, opt, // pointeurs, dans des boucles
			area, // la zone occupée par le lien
			loading = byId('izLoading'), // image de preloader (peut valoir undefined)
			loadingArea, // zone dans laquelle centrer le preloader
			loadingPos; // position le la zone où centrer le preloader
		
		// attention aux réouvertures alors qu'un préchargement a lieu
		if (loading) {
			iz.close();
		}
		
		// réservé à l'ouverture initiale :
		if (!iz.isOpen) {
			// lecture des options et mise en place des options par défaut
			options = options || {};
			for (opt in iz.defaultOpt ) {
				if (options[opt] === undefined) {
					options[opt] = iz.defaultOpt[opt];
				}
			}
			iz.options = options; // mémorisation
			
			// relever le n° de l'image qu'on est en train d'ouvrir
			while (iz.gal[i] !== actionner && i < iz.gal.length) {
				i++;
			}
			iz.active = i;
		}
		options = iz.options;
		
		// déterminer la surface occupée par le lien
		area = actionner.firstChild.nodeType === 3 ? actionner : actionner.firstChild; // pas toujours pertinent, mais souvent
			
		// mise en place du preloader
		loading = addElem("img");
		loading.src = options.preloaderUrl;
		loading.id = 'izLoading';
		loadingArea = byId('izImg') || area; // selon qu'imZoom est déjà ouvert ou non, on se réfère à l'actionneur ou à la gde image
		loadingPos = getPos(loadingArea);
		loading.onclick = iz.close;
		setStyle(loading, {
			position : 'absolute',
			zIndex : options.zIndex,
			top : (loadingArea.offsetHeight - loading.offsetHeight) / 2 + loadingPos.t + 'px', // centré dans la hauteur
			left : (loadingArea.offsetWidth - loading.offsetWidth) / 2 + loadingPos.l + 'px' // centré dans la largeur
		});
			
		// mémoriser les paramètres
		iz.actionner = actionner;
		iz.area = area;
		
		// charger l'image et mémoriser ses dimensions
		iz.loadImg();
	},
	
	
	/**
	 * loadImg()
	 * -------------------------------------------------------------------------
	 * charge une image, prend ses mesures normales, et lance son affichage
	 */
	loadImg : function () {
		
		var iz = imZoom,
			izTmp = addElem("img");
		
		// création d'une image temporaire (invisible)
		izTmp.id = 'izTmp';
		setStyle(izTmp, {
			visibility: 'hidden',
			position: 'absolute',
			top: '0px',
			left: '0px'
		});
		
		// actions sur cette image :
		izTmp.onclick = iz.close;
		
		izTmp.onload = function () {
			setTimeout(
				function(){
					// prise des mesures de l'image
					iz.imgSize = {
						w: izTmp.offsetWidth,
						h: izTmp.offsetHeight
					};
					
					// suppression de l'image temporaire et du preloader
					iz.remove('izLoading');
					
					// affichage de l'image dans imZoom
					if (!iz.isOpen) {
						iz.open();
					}
					else {
						iz.remove('izTmp');
						iz.change();
					}
				},
				1
			);
		};
		
		izTmp.src = iz.actionner.href;
	},
	
	
	/**
	 * getImgDim()
	 * -------------------------------------------------------------------------
	 * relève les mesures max pour l'image courante
	 */
	getImgDim : function () {
		
		var iz = imZoom;
		
		if (iz.isOpen) {
			
			var winDims = winDim(),
				opt = iz.options,
				maxSize = opt.maxSize,
				imgSize = iz.imgSize,
				izGlob = byId('izGlob'),
				izImg = byId('izImg'),
				globMes, // mesure du conteneur global (sans l'image)
				maxSizeDims, // dimensions pour l'image
				ret; // valeur de retour : {w,h}
				
	
			// si ce n'est fait, lire la mesure du conteneur global (sans l'image)
			// j'ignore pourquoi, mais ça déconne qd he recalcule à chaque fois
			if (!iz.globMes) {
				iz.globMes = {
					w : izGlob.offsetWidth - izImg.offsetWidth,
					h : izGlob.offsetHeight - izImg.offsetHeight
				};
			}
			globMes = iz.globMes;
	
			// calculer et retourner les dimensions pour l'image
			maxSizeDims = {
				w : winDims.w - globMes.w,
				h : winDims.h - globMes.h
			};
			
			ret = redimArea(imgSize.w, imgSize.h, {
				max_w : maxSize ? Math.min(maxSizeDims.w, imgSize.w) : maxSizeDims.w,
				max_h : maxSize ? Math.min(maxSizeDims.h, imgSize.h) : maxSizeDims.h
			});
			
			return ret;
		}
	},
	
	
	
	/**
	 * getAnimOpenMes()
	 * -------------------------------------------------------------------------
	 * retourne les mesures de départ et de fin pour l'animation d'ouverture
	 */
	getAnimOpenMes : function () {
		var izTmp = byId('izTmp'),
			izImg = byId('izImg'),
			tmpMes, imgMes,
			px = "px"; // pour jsMin
			
		tmpMes = getPos(izTmp);
		imgMes = getPos(izImg);

		return {
			from : {
				width : izTmp.offsetWidth + px,
				height : izTmp.offsetHeight + px,
				top : tmpMes.t + px,
				left : tmpMes.l + px
			},
			to : {
				width : izImg.offsetWidth + px,
				height : izImg.offsetHeight + px,
				left : imgMes.l + px,
				top : imgMes.t + px
			}
		};
	},
	
	
	
	/**
	 * setPos()
	 * -------------------------------------------------------------------------
	 * (re)positionne les éléments de imZoom dans la fenêtre
	 */
	setPos : function () {
		
		var  iz = imZoom;
		
		// si on a effectivement une image d'ouverte
		if (iz.isOpen) {
			
			// raccourcis
			var izScreen = byId('izScreen'), // je ne prends pas directement le style car ça fait boguer ie
				izGlob = byId('izGlob'),
				izImg = byId('izImg'),
				scroll = scrolled(),
				winDims = winDim(),
				pageDims = pageDim(),
				imgDims = iz.getImgDim(),
				px = "px"; // pour jsMin
			
			// ajustement de l'image
			izImg.width = imgDims.w; // plus agréable à l'oeil que height, lors de onchange, sans anim
			
			// ajustement du conteneur global
			setStyle(izGlob, {
				top : Math.round((winDims.h - izGlob.offsetHeight) / 2) + scroll.y + px,
				left : Math.round((winDims.w - izGlob.offsetWidth) / 2) + scroll.x + px
			});
			
			// modifier l'animation d'ouverture
			if (iz.animOpen && iz.animOpen.framesLeft) {
				iz.animOpen.go(iz.getAnimOpenMes());
			}
			
			// ajustement de l'écran modal
			// (le redimensionnement de la fenêtre peut modifier les dimensions de la page)
			setStyle(izScreen, {display: 'none'});
			setStyle(izScreen, {
				width : pageDims.w + px,
				height : pageDims.h + px
			});
			setStyle(izScreen, {display: ''});
		}
	},
	
	/**
	 * remove()
	 * -------------------------------------------------------------------------
	 * s'il existe, retire du dom l'élément dont l'identifiant est /id/
	 */
	remove : function (id) {
		var elem = byId(id);
		if (elem) {
			elem.parentNode.removeChild(elem);
		}
	},
	
	/**
	 * cancelLoading()
	 * -------------------------------------------------------------------------
	 * annule le chargement d'une image
	 */
	cancelLoading : function (id) {
		var izTmp = byId('izTmp');
		if (izTmp) {
			izTmp.onload = function () {};
		} // delete et izTmp.onload=0 boguent sous ie
		imZoom.remove('izLoading');
	},
	
	/**
	 * close()
	 * -------------------------------------------------------------------------
	 * ferme la imZoom
	 */
	close : function () {
		
		var iz = imZoom;
		
		iz.isOpen = 0;
		
		remEvent(document, 'keydown', iz.keyNav);
		
		// arrêter ce qui est en cours
		if (iz.prog) {
			iz.pause();
		}
		iz.cancelLoading();
		
		// détruire les éléments html
		iz.remove('izLoading');
		iz.remove('izTmp');
		iz.remove('izGlob');
		iz.remove('izScreen');
		
		// callback
		iz.callback('onClose');
	},
	
	/**
	 * open()
	 * -------------------------------------------------------------------------
	 * déclenche l'affiche la grande image dans un calque de premier plan
	 */
	open : function () {
		
		var iz = imZoom;
		
		// si on a pas déjà une image ouverte
		if (!iz.isOpen) {
			iz.isOpen = 1;
			
			// raccourcis et déclarations de variables
			var pageDims = pageDim(),
				opt = iz.options,
				izGlob, // conteneur global
				izCont, // conteneur designable
				izScreen, // l'écran modal
				izMeta, // le conteneur du titre et de la nav
				izImg, // l'image
				izTmp = byId('izTmp'),
				zero = "0px", div = "div"; // pour jsMin
			
			// création des éléments
				
				// un écran modal
				izScreen = addElem(div);
				izScreen.id='izScreen';
				setStyle(izScreen, {
					position : 'absolute',
					backgroundColor : opt.screenColor,
					top : zero,
					left : zero,
					width : pageDims.w+'px',
					height : pageDims.h+'px',
					zIndex : opt.zIndex
				});
				css3(izScreen).opacity(0);
				
				// un conteneur global
				izGlob = addElem(div);
				if (opt.anim) {
					css3(izGlob).opacity(0);
				}
				setStyle(izGlob, {
					position : 'absolute',
					top : zero,
					left : zero,
					zIndex : opt.zIndex,
					textAlign : 'center'
				});
				izGlob.id='izGlob';
				
				// un conteneur designable
				izCont = addElem(div,izGlob);
				izCont.id='izCont';
				
				// une image dans le conteneur (izImg.src est donnée plus bas)
				izImg = addElem("img",izCont);
				izImg.id='izImg';
				izImg.onload = function(){
					setTimeout( // Google Chrome me contraint à un timeout
						iz.openAnim,
						1
					);
				};
				
				// une barre de nav dans le conteneur
				izMeta = addElem(div,izCont);
				izMeta.id = 'izMeta';
				if ( !opt.showNav && !opt.showTitle ) {izMeta.style.display='none';}
				if (opt.showTitle) { izMeta.innerHTML = '<span id="izTitle">'+iz.gal[iz.active].title+'</span>'; }
				if (opt.showNav && iz.gal.length>1) {
					izMeta.innerHTML += '' +
					'<span id="izNav">' +
					' <a href="#" id="izPrev" onclick="imZoom.prev();return false;">'+opt.prevTxt+'</a>' +
					' <a href="#" id="izPlay" onclick="imZoom.play();return false;">'+opt.playTxt+'</a>' +
					' <a href="#" id="izPause" style="display:none;" onclick="imZoom.pause();return false;">'+opt.pauseTxt+'</a>' +
					' <a href="#" id="izNext" onclick="imZoom.next();return false;">'+opt.nextTxt+'</a>' +
					'</span>';
				}
					
				// actions de clics sur les différents élements
				izScreen.onclick = izGlob.onclick = iz.close;
				izCont.onclick=function (e) { // éviter qu'un clic sur la zone de design ne ferme imZoom
					e = e||event;
					if (e.stopPropagation) { e.stopPropagation(); } 
					e.cancelBubble = true;
				};
				
				// on n'indique l'url de l'image qu'au dernier moment, car son chargement déclenche la suite
				izImg.src = iz.actionner.href;
		}
	},
	
	/**
	 * openAnim()
	 * -------------------------------------------------------------------------
	 * (non-)animation d'ouverture
	 */
	openAnim : function () {
		
		var iz = imZoom;
		
		// si on a pas déjà une image ouverte
		if (iz.isOpen) {
			
			var	opt = iz.options,
				area = iz.area, // raccourci pour la zone de l'actionneur
				areaHeight, areaWidth, areaPos, // position/mesures de l'actionneur
				izGlob = byId("izGlob"), // conteneur global
				izMeta = byId("izMeta"), 
				izTmp = byId("izTmp"), 
				screenStyle, // styles pour l'écran, une fois ouvert
				globStyle, // styles pour le conteneur global, une fois ouvert
				animOpenMes, // mesures from/to pour l'animation d'ouverture
				animScreen, // animation de l'écran
				onOpen, // actions à effectuer à la fin des (non-)animations
				imgMes, // mesures de l'image
				izTmpFrom, // mesures de départ pour l'animation d'ouverture
				rien;
				
			areaPos = getPos(area);
			areaWidth = area.offsetWidth;
			areaHeight = area.offsetHeight;
			
			// prépartion des (non-)animations
			
				// relevé de mesures préalable
				if ( opt.showNav || opt.showTitle ) {
					izMeta.style.display = '';
				}
				iz.setPos();
				imgMes = getPos( byId( "izImg" ) );

				// mesures finales pour les différents éléments
				screenStyle = { opacity : opt.screenOpacity };
				globStyle = { opacity : 1 };
				animOpenMes = iz.getAnimOpenMes();
				
				// actions à effectuer à la fin des (non-)animations
				onOpen = function () {
					if (iz.options.autoPlay) {iz.play();}
					addEvent(document, 'keydown', iz.keyNav); // keydown est le seul qui accepte "enter" et "escape" sous ie, mais il n'accepte pas le prevent default
					iz.callback('onOpen');
					iz.remove('izTmp');
				};

			// ouverture, avec animation
			if (opt.anim) {
				
				// encore quelques préparatifs
					
					// régler le fondu du conteneur global
					iz.animGlob = new Anim(izGlob, {duration: opt.animDuration / 2, ease: opt.animEase});
					
					// faire en sorte que l'image ne soit pas déformée (surtout en cas de liens textuels)
					izTmpFrom = redimArea(izTmp.offsetWidth, izTmp.offsetHeight, {
						max_w : areaWidth,
						max_h : areaHeight
					});
					
					// faire en sorte que l'image soit centrée dans son actionneur
					izTmpFrom.l = (areaWidth - izTmpFrom.w) / 2 + areaPos.l;
					izTmpFrom.t = (areaHeight - izTmpFrom.h) / 2 + areaPos.t;
				
				// et on y va !
				
					// affichage de l'écran modal
					animScreen = new Anim(byId("izScreen"), {to:screenStyle,from:{opacity:0},duration:opt.animDuration,ease:opt.animEase}).go();
					
					// effet de zoom sur l'image (suivi de l'apparition du conteneur global, en fondu)
					iz.animOpen = new Anim(izTmp, {
						duration : opt.animDuration,
						ease : opt.animEase,
						from : {
							width : izTmpFrom.w+'px',
							height : izTmpFrom.h+'px',
							top : izTmpFrom.t+'px', // pour faire l'économie du centrage : "top : areaPos.t+'px',"
							left : izTmpFrom.l+'px' // pour faire l'économie du centrage : "left : areaPos.l+'px'"
						},
						to : animOpenMes.to,
						onStart : function () {
							// réafficher izTmp avant de l'animer
							izTmp.style.zIndex=opt.zIndex+1;
							setTimeout(function () {izTmp.style.visibility='';},50);
						},
						onFinish : function () {
							iz.setPos();
							iz.animGlob.go({
								from : { opacity : 0 },
								to : globStyle,
								onFinish : onOpen
							});
						}
					}).go();
			}
			
			// ouverture, sans animation
			else {
				setStyle(byId("izScreen"), screenStyle);
				setStyle(izTmp, animOpenMes.to);
				setStyle(izGlob, globStyle);
				onOpen();
			}
			
		}
	}
};


// en cas de scroll ou redimentionnement de la fenêtre, repositionner l'agrandissement
addEvent(window, 'resize', imZoom.setPos);
addEvent(window, 'scroll', imZoom.setPos);

return imZoom;

})(window,document);