function stampaProdotti(prodotti){
    let result = "";

    for(let i=0; i < prodotti.length; i++){
        let prodotto = `
        <article>
            <header>
                <div>
                    <img src="${prodotti[i]["product_image"]}" alt="" />
                </div>
                <h2>${prodotti[i]["desccompletaformula"]}</h2>
                <p>${prodotti[i]["nome"]}}</p>
            </header>
            <section>
                <p>${prodotti[i]["descformula"]}</p>
            </section>
            <footer>
                <a href="prodotto.php?id=${prodotti[i]["product_id"]}">Leggi tutto</a>
            </footer>
        </article>
        `;
        result += prodotto;
    }
    return result;
}

$(document).ready(function(){
    $.getJSON("api-prodotto.php", function(data){
        let prodotti = stampaProdotti(data);
        const main = $("main");
        main.append(prodotti);
    });
});

