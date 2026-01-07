WEB ESCOLLIDA:

La web que vaig escollir jo és la de EA, o Electronic Arts (la web és ea.com), que és una empresa que es basa en el disseny i desenvolupament de videojocs. Aquesta empresa l'he transformat en "EEats" o "Electronic Eats" amb una pàgina web que té un estil molt similar a la web de l'empresa original.

PÀGINES DE LA WEB:

El projecte té una pàgina home, una de productes, de login, de registrar-se, pàgina d’usuari, de carretó, de informació de pagament, de confirmació de compra, de login d’usuari administrador i panell d’administrador.


FUNCIONAMENT ESPECIAL DE PÀGINES:

HOME:

A la pàgina home surten els productes que tenen lines de comanda relacionada, i estan ordenades per número de lines de comanda que tenen. Estan limitats a 6 productes.

Els descomptes de la pàgina home que surten són basats en els productes que tenen relacionats un descompte, però la funcionalitat de productes tenint descompte no esta posada (només es poden fer descomptes amb cupons). Estan limitats a 3 descomptes.

PRODUCTES:

Es mostren tots els productes amb un estil similar a l'HOME però no están limitats a 6

PÀGINA D'USUARI:

S'accedeix clicant la icona de la persona en la capçalera una vegada hem iniciat sessió.

LOGIN D'ADMINISTRADOR:

Ens inicia la sessió per 10 minuts, després d'això hem de fer login un altre cop.


PANELL D'ADMINISTRACIÓ:

Tots els formularis dels menús funcionen de la mateixa forma:

Comença sense ID seleccionat, si s'envia el formulari es creara un nou camp, sempre que l'id segueixi de seleccionat.

Quan cliquem al botó de edit d'algun camp, se'ns posa totes les dades en el formulari, i s'assigna l'ID d'aquest usuari. Si s'envia el formulari amb aquest id seleccionat, s'editara la fila seleccionada.

Si volem desseleccionar un ID, hem de clicar el boto de "reset"

El filtre dels preus afecta a tots els camps que mostrin un preu o una quantitat de diners, només a aquests. Els valors que s'envien a la base de dades i que es posen en el formulari son d'euro sense importar la moneda seleccionada.

He considerat que seria millor si no deixes esborrar lines de comanda, perquè si es volgués esborrar una línia, s'edités o és borres la comanda sencera (Potser sí que haurà estat bé posar un botó de esborrar, ja que editar o crear línies des de admin és estrany igualment).

BASE DE DADES

Hi ha bastants camps que no s'utilitzen, que hauria volgut utilitzar per funcionalitats extra. Alguns d'aquest a mencionar són:
Tot el que sigui "premium"
Delivery date, delivery type i adress de comandes.
Stock de productes,
Type, Uses de discounts

Hi ha moltes taules i models que no s'utilitzen, pero he pensat que seria millor deixar-les per que es vegi que estaven fetes ja de primeres

Algunes taules tenen un soft delete per preservar dades borrades. Altres no ho tenen per conflictes amb camps únics.


