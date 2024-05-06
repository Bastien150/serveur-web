let { Router, Route, IndexRoute, IndexLink, hashHistory, Link } = ReactRouter;

//body accueil
let accueil = React.createClass({
  displayName: "accueil",
  render: function () {
    return React.createElement('section', { className: 'container-home' },
      React.createElement('section', { className: 'banner' },
        React.createElement('header', null,
          React.createElement('h2', { className: 'title-home' }, 'Bienvenue sur le jeu du loto !')
        )
      ),
      React.createElement('section', { className: 'container-h' },
        React.createElement('div', { className: 'divison' },
          React.createElement('div', { className: 'definition-home' },
            React.createElement('section', { className: 'first' },
              React.createElement('i', { className: 'icon featured alt fa-gamepad' }),
              React.createElement('header', null,
                React.createElement('h2', { className: 'title-home' }, 'Loto')
              ),
              React.createElement('p', { className: 'text' }, 'Ce site vise à dissuader l\'addiction en illustrant la rareté des victoires, jouez de manière responsable.')
            )
          ),
          React.createElement('div', { className: 'definition-home' },
            React.createElement('section', { className: 'middle' },
              React.createElement('i', { className: 'icon featured alt2 fa-desktop' }),
              React.createElement('header', null,
                React.createElement('h2', { className: 'title-home' }, 'Site est un SPA')
              ),
              React.createElement('p', { className: 'text' }, 'Ce site web est un single page application, il charge dynamiquement son contenu sur la page actuelle.')
            )
          ),
          React.createElement('div', { className: 'definition-home' },
            React.createElement('section', { className: 'last' },
              React.createElement('i', { className: 'icon featured alt fa-mobile-screen' }),
              React.createElement('header', null,
                React.createElement('h2', { className: 'title-home' }, 'Site responsive')
              ),
              React.createElement('p', { className: 'text' }, 'Ce site web s\'adapte aux téléphones comme aux ordinateurs pour une expérience optimale.')
            )
          )
        ),
        React.createElement('div', null,
          React.createElement(IndexLink,{ to: "/jeu", className: 'button-h' }, 'Jouer'),
          React.createElement(IndexLink,{ to: "/regles", className: 'button-h' }, 'Règles')
        )
      )
    );
  },
});

//body règles
let regles = React.createClass({
  displayName: "regles",
  render: function () {
    return React.createElement(
      'div', null,
      React.createElement("div",{ className: "title" },
        React.createElement("h1", null, "Règles :")),
      React.createElement('div',{ className: 'content-rules' },
      React.createElement('div',{ className: 'card-rules' },
        React.createElement('h3', { className: 'cardrules__title' }, 'Règle 1 :'),
        React.createElement('p', { className: 'card__content' }, 'Choisissez 5 numéros initiaux')
      ),
      React.createElement('div',{ className: 'card-rules' },
        React.createElement('h3', { className: 'cardrules__title' }, 'Règle 2 :'),
        React.createElement('p', { className: 'card__content' }, 'Choisissez 1 numéro complémentaire')
      ),
      React.createElement('div',{ className: 'card-rules' },
        React.createElement('h3', { className: 'cardrules__title' }, 'Règle 3 :'),
        React.createElement('p', { className: 'card__content' }, 'Une fois les numéros choisis, Validez et jouer !')
      )),
      React.createElement('div',{ className: 'card-vict' },
        React.createElement('p', { className: 'index cardvic__title' }, 'Bouton Victoire (Regarde moi)'),
        React.createElement('div',{ className: 'cardvic__content' },
          React.createElement('p', { className: 'cardvic__title' }, 'Le Bouton Victoire'),
          React.createElement('p',{ className: 'cardvic__description' },'Ce bouton permet de voir combien d\'essais auraient pu conduire à l\'obtention des 6 boules choisies. Il permet de constater que le loto est une perte d\'argent et agit en tant que mesure préventive en cas d\'addiction.')
        )
      ),
      React.createElement(IndexLink,{ to: "/jeu", className:"buttongame" },"Cliquez ici jouer",
      React.createElement('span',{ className: 'play' },null))
    );
  },
});

//body jeu loto
let jeu = React.createClass({
  displayName: "jeu",

  componentDidMount: function () {
    this.script = document.createElement('script');
    this.script.src = './js/jsloto.js';
    document.body.appendChild(this.script);
  },
  componentWillUnmount: function () {
    document.body.removeChild(this.script);
  },
  

  render: function () {
    return React.createElement("div",{ className: "bottom" },
      React.createElement("div",{ className: "title" },
        React.createElement("h1", null, "Loto")),
      React.createElement("div",{ className: "card" },
        React.createElement("h2",{ className: "whole" }, "Grille :"),
        React.createElement("div",{ className: "whole" },
          React.createElement("table", null,
            React.createElement("tr", null,
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "" },"")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "1" },"1")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "2" },"2")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "3" },"3")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "4" },"4")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "5" },"5")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "6" },"6")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "7" },"7")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "8" },"8")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "9" },"9")),
            ),
            React.createElement(
              "tr", null,
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "10" },"10")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "11" },"11")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "12" },"12")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "13" },"13")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "14" },"14")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "15" },"15")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "16" },"16")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "17" },"17")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "18" },"18")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "19" },"19")),
            ),
            React.createElement(
              "tr", null,
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "20" },"20")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "21" },"21")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "22" },"22")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "23" },"23")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "24" },"24")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "25" },"25")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "26" },"26")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "27" },"27")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "28" },"28")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "29" },"29")),
            ),
            React.createElement(
              "tr", null,
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "30" },"30")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "31" },"31")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "32" },"32")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "33" },"33")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "34" },"34")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "35" },"35")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "36" },"36")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "37" },"37")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "38" },"38")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "39" },"39")),
            ),
            React.createElement(
              "tr", null,
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "40" },"40")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "41" },"41")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "42" },"42")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "43" },"43")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "44" },"44")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "45" },"45")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "46" },"46")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "47" },"47")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "48" },"48")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cell", "data-value": "49" },"49")),
            ),
            React.createElement(
              "tr", {className: "numcompl"},
              React.createElement("td", null,
                React.createElement("div",{ className: "cellcomp", id: "comp", "data-value": "1" },"1")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cellcomp", id: "comp", "data-value": "2" },"2")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cellcomp", id: "comp", "data-value": "3" },"3")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cellcomp", id: "comp", "data-value": "4" },"4")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cellcomp", id: "comp", "data-value": "5" },"5")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cellcomp", id: "comp", "data-value": "6" },"6")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cellcomp", id: "comp", "data-value": "7" },"7")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cellcomp", id: "comp", "data-value": "8" },"8")),
              React.createElement("td", null,
                React.createElement("div",{ className: "cellcomp", id: "comp", "data-value": "9" },"9")),
            )
          ),
          React.createElement("div",{ className: "button" },
          React.createElement("input",{ type: "button", id: "valider", value: "Valider"}),
          React.createElement("input",{ type: "button", id: "jouer", disabled: true, value: "Jouer"}),
          React.createElement("input",{ type: "button", id: "gagner", disabled: true, value: "Victoire"}),
          ),
        )
      ),
      React.createElement("div",{ className: "card", id: "disp", style: { display: "none" } },
        React.createElement("h2", { className: "whole" }, "Récapitulatif :"),
        React.createElement("div",{ className: "padding whole" },
          React.createElement("div",{ className: "grid" },
            React.createElement("div", { className: "line", id: "boulej" }, React.createElement("div", { id: "tirage" })),
            React.createElement("div", { className: "line", id: "boulealea" }, React.createElement("div", { id: "tiragealea" })),
            React.createElement("h6", { id: "commentaire", className: "comm whole"})
          )
        )
      )
    )
  },
});

//bar de navigation
let nav = React.createClass({
  displayName: "nav",
  render: function () {
    return React.createElement("div",null,
      React.createElement("header",null,
        React.createElement("ul",{ className: "nav-links" },

          //accueil
          React.createElement("li",{ className: "center" },
            React.createElement(IndexLink,{ to: "/", activeClassName: "active", ClassName: "link" },"Accueil")
          ),

          //Règles
          React.createElement("li",{ className: "center" },
            React.createElement(IndexLink,{ to: "/regles", activeClassName: "active", ClassName: "link" },"Règles")
          ),

          //Jeu loto
          React.createElement("li",{ className: "center" },
            React.createElement(IndexLink,{ to: "/jeu", activeClassName: "active", ClassName: "link" },"Jeu")
          )
        )
      ),
      React.createElement("div", {}, this.props.children)
    );
  },
});

let destination = document.querySelector("#container");

ReactDOM.render(
  React.createElement(Router,{history: hashHistory },
    React.createElement(Route,{ path: "/", component: nav },
      React.createElement(IndexRoute, { component: accueil }),
      React.createElement(Route, { path: "regles", component: regles }),
      React.createElement(Route, { path: "jeu", component: jeu })
    )
  ),
  destination
);