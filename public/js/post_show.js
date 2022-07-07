function onResponse(response) {
    if(!response) {
        return null;
    } else return response.json();
}

function jsonRemComm(json) {
    var cella;
    console.log(json);
    if(json.exists === true) {
        console.log(json.exists);
        var lista_commenti = document.getElementsByClassName('box_commento');
        console.log(lista_commenti);

        for(let i=0;i<lista_commenti.length ; i++) {
            console.log(lista_commenti[i].attributes[0].value);
            console.log(json.id)
            if(lista_commenti[i].attributes[0].value == json.id) {
                cella = lista_commenti[i];
                console.log(cella.parentNode.parentNode.parentNode.childNodes[5].childNodes[3].childNodes[2].textContent);
                cella.parentNode.parentNode.parentNode.childNodes[5].childNodes[3].childNodes[2].textContent = cella.parentNode.parentNode.parentNode.childNodes[5].childNodes[3].childNodes[2].textContent -1;
                cella.remove();
            }
        }
    } else {
        console.log('errore');
    }
}


function RemComm(event) {
    let y = event.currentTarget.parentNode.parentNode.parentNode;
    console.log(y);
    let idc = y.attributes[0].value;

    console.log(idc);
    fetch('remove_comment/'+idc).then(onResponse).then(jsonRemComm);

}

function closeComm(event) {
    console.log('sono in close');
    let comms = event.currentTarget.parentNode.parentNode.parentNode.lastChild.previousSibling;
    console.log(event.currentTarget);
    console.log(comms);

    comms.classList.add('hidden');
    event.currentTarget.removeEventListener('click', closeComm);
    event.currentTarget.addEventListener('click', openShowComm);

}

function jsonCommShow(json) {
    var cella;
    var sel_box;
    if(json.length == 0 ) {


        console.log("non ci sono commenti");

    } else {
    let all_comm = json;
    console.log(all_comm);
    const box_c = document.getElementsByClassName('box_pos');
    console.log(box_c);
    for(let l = 0; l<box_c.length; l++){
        console.log(box_c[l].attributes[2].value);
        console.log(all_comm[0].post);

        if(box_c[l].attributes[2].nodeValue == json[0].post){
          console.log(box_c[l].lastChild.previousSibling.lastChild.previousSibling);
            sel_box = box_c[l].lastChild.previousSibling.lastChild.previousSibling;
            break;
            console.log(sel_box);
        }
    }

    for(c in all_comm) {
         console.log(sel_box);




        // creo i contenitori
        const box_commento = document.createElement('div');
        box_commento.setAttribute('data-id', all_comm[c].id);
        box_commento.classList.add('box_commento');
        const top_com = document.createElement('div');
        const top_img_user = document.createElement('div');
        top_com.classList.add('top_com');
        top_img_user.classList.add('top_img_user');
        const box_img_comm = document.createElement('div');
        box_img_comm.classList.add('box_img_comm');
        const box_user_time = document.createElement('div');
        box_user_time.classList.add('box_user_time');
        const box_destroy = document.createElement('div');
        box_destroy.classList.add('box_destroy');
        const box_text = document.createElement('div');
        box_text.classList.add('box_text');

        //creo i tag HTML
        const img_comm = document.createElement('img');
        img_comm.classList.add('img_comm');
        const user = document.createElement('h3');
        const time = document.createElement('span');
        const text = document.createElement('p');

        img_comm.src = all_comm[c].image;
        console.log(all_comm[c]);
        user.textContent = all_comm[c].username;
        time.textContent = all_comm[c].time;
        text.textContent = all_comm[c].text;

        if(all_comm[c].user == document.getElementById('user_case').dataset.id) {
            const delet = document.createElement('buttom');
            delet.textContent = "Elimina";
            delet.addEventListener('click', RemComm);
            box_destroy.appendChild(delet);
        }

        box_text.appendChild(text);
        box_user_time.appendChild(user);
        box_user_time.appendChild(time);
        box_img_comm.appendChild(img_comm);

        top_img_user.appendChild(box_img_comm);
        top_img_user.appendChild(box_user_time);

        top_com.appendChild(top_img_user);
        top_com.appendChild(box_destroy);


        box_commento.appendChild(top_com);
        box_commento.appendChild(box_text);



        sel_box.appendChild(box_commento);

        const id_c = document.createElement('span');
        id_c.textContent = all_comm[c].id;







    }

    }
}

function commentShow(c) {
    console.log(c);


    let g = c.parentNode.parentNode.parentNode;

    console.log(g);

    fetch( BASE_URL +'show_comments/'+ g.dataset.id).then(onResponse).then(jsonCommShow);

}


function jsonAggComm(json) {
    if(json.exists === true) {
        console.log(json.exists);
        document.querySelector('comments').innerHTML ='';
        commentShow(c);
    } else {
        console.log('errore');
    }
}




function openShowComm(event) {
    console.log('riapro commenti');
    let h = event.currentTarget;
    console.log(h.parentNode);
    h.removeEventListener('click', openShowComm);
    h.addEventListener('click', closeComm);


    console.log(' apro lo show');
    let c = event.currentTarget.parentNode.parentNode.parentNode;
    console.log(c);
    console.log(c.lastChild.previousSibling.childNodes[1].childNodes[1].childNodes[3]);
    c.querySelector('section').classList.remove('hidden');
    c.lastChild.previousSibling.childNodes[1].childNodes[1].childNodes[3].value = c.dataset.id;


    console.log(c.lastChild);
    console.log('ho rimosso la classe dalla sezione');

    commentShow(h);




}



function jsonRimLike(json) {
    console.log(json);
    var cel;
    if(json.exists === true) {
        var boxs = document.getElementsByClassName('box_pos');
        console.log(boxs);
        for(let w = 0 ; w< boxs.length; w++) {
            console.log(json.idp);
            if(boxs[w].attributes['data-id'].value == json.idp){
               cel = boxs[w];
                console.log(cel.childNodes[5].childNodes[1].childNodes[2]);
                cel.childNodes[5].childNodes[1].childNodes[1].src = "image/like.png";
                cel.childNodes[5].childNodes[1].childNodes[2].textContent = cel.childNodes[5].childNodes[1].childNodes[2].textContent -1;
                cel.childNodes[5].childNodes[1].childNodes[1].removeEventListener('click', RimLike);
                cel.childNodes[5].childNodes[1].childNodes[1].addEventListener('click', AddLike);

            }
        }


    } else {
        console.log('errore');
    }
}



function RimLike(event) {
    let box = event.currentTarget.parentNode.parentNode.parentNode.dataset.id;
    console.log(box);
    fetch(BASE_URL+'remove_like/'+box).then(onResponse).then(jsonRimLike);

}






    function jsonAddLike(json) {
        console.log(json);
        var cel;

            var boxs = document.getElementsByClassName('box_pos');
            console.log(boxs);
            for(let w = 0 ; w< boxs.length; w++) {
                console.log(json.post);
                console.log(boxs[w].attributes[2].value);
                if(boxs[w].attributes[2].value == json.post){
                   cel = boxs[w];
                    console.log(cel.lastChild.previousSibling.previousSibling.previousSibling.firstChild.nextSibling.firstChild.nextSibling);
                    cel.lastChild.previousSibling.previousSibling.previousSibling.firstChild.nextSibling.firstChild.nextSibling.src = "image/unlike.png";
                    let prova = cel.lastChild.previousSibling.previousSibling.previousSibling.firstChild.nextSibling.lastChild.textContent;
                    prova++;
                    console.log(cel.lastChild.previousSibling.previousSibling.previousSibling.firstChild.nextSibling.lastChild);
                    console.log(prova);
                  cel.lastChild.previousSibling.previousSibling.previousSibling.firstChild.nextSibling.lastChild.textContent = prova;
                  cel.lastChild.previousSibling.previousSibling.previousSibling.firstChild.nextSibling.firstChild.nextSibling.removeEventListener('click', AddLike);
                    cel.lastChild.previousSibling.previousSibling.previousSibling.firstChild.nextSibling.firstChild.nextSibling.addEventListener('click', RimLike);

                }
            }



    }


function AddLike(event) {
    let idp = event.currentTarget.parentNode.parentNode.parentNode.dataset.id;
    console.log(idp);
    fetch(BASE_URL+'add_like/'+idp).then(onResponse).then(jsonAddLike);

}





 function jsonPosts(json) {
  const view_post = document.getElementById('posts');
  view_post.classList.add('view_post');
  var all_posts = json.posts;
  console.log(all_posts);
  var n_post = all_posts.length;
  console.log(n_post);
  const box_prova = document.getElementById('box_post');
  //view_post.innerHTML='';
  for(let p in all_posts) {

    console.log(box_prova);
    let clone = box_prova.cloneNode(true);
    clone.classList.remove('hidden');
    clone.classList.add('box_pos');
    clone.dataset.id= all_posts[p].id;
    console.log(clone);
    let top_post = clone.firstChild.nextSibling;
    console.log(top_post.firstChild.nextSibling.firstChild);
    top_post.firstChild.nextSibling.firstChild.src = all_posts[p].image;
    let con_username_data = top_post.lastChild.previousSibling;
    let prova = con_username_data.firstChild.nextSibling;
    console.log(prova);
    let username_post = document.createElement('h3');
    username_post.textContent = all_posts[p].username;
    prova.appendChild(username_post);

    let con_data = con_username_data.lastChild.previousSibling;
    console.log(con_data);

    let data = document.createElement('p');
    data.textContent = all_posts[p].time;

    con_data.appendChild(data);

    // inserisco il corpo del post

    let con_comp = clone.childNodes[3];

    let con_tes = con_comp.firstChild.nextSibling;
    let t = document.createElement('p');
    t.textContent = all_posts[p].text;
    con_tes.appendChild(t);
    console.log(con_tes);

    let con_cont = con_comp.lastChild.previousSibling;

    console.log(con_cont);

    if(all_posts[p].type === 'spotify') {
        let iframe = document.createElement('iframe');
        console.log(all_posts[p].ele);
        iframe.src = "https://open.spotify.com/embed/track/"+encodeURIComponent(all_posts[p].ele);
        iframe.frameBorder = 0;
        iframe.setAttribute('allowtransparency', 'true');
        iframe.allow = "encrypted-media";

        iframe.classList = "track_iframe";
        con_cont.appendChild(iframe);

    } else {
        const image = document.createElement('img');
        console.log(typeof(all_posts[p]));
        image.src = all_posts[p].ele;
        con_cont.appendChild(image);
    }





    let comment = clone.lastChild.previousSibling.previousSibling.previousSibling.lastChild.previousSibling.firstChild.nextSibling;

    comment.addEventListener('click', openShowComm);
    view_post.appendChild(clone);
    let con_like = clone.lastChild.previousSibling.previousSibling.previousSibling.firstChild.nextSibling;
    const like = document.createElement('img');
    const n_likes = document.createElement('p');
    n_likes.textContent = all_posts[p].nlikes;
    console.log(like);
    const lk = json.likes;
    if(lk.length == 0){
      console.log('ci sono 2');

        like.src = "image/like.png";
        like.addEventListener("click", AddLike);
    }
    console.log(lk);
    for(let f in lk) {
      //console.log(lk[f].user);
    // controllo se l'utente loggato ha messo il like
    if(lk[f].user == document.getElementById('user_case').dataset.id && lk[f].post == all_posts[p].id){
        console.log('ci sono');
        like.src = "image/unlike.png";
        like.addEventListener('click', RimLike);
    }
     else {
      console.log('ci sono 2');

        like.src = "image/like.png";
        like.addEventListener("click", AddLike);
    }


}
con_like.appendChild(like);
con_like.appendChild(n_likes);
    // creao il tag per inserire il numero di commenti
    let n_c = clone.childNodes[5].lastChild.previousSibling;
    let num_com = document.createElement('p');
    num_com.textContent = all_posts[p].ncomments;
    console.log(n_c);

    n_c.appendChild(num_com);





  }
}


async function postShow() {

    await fetch(BASE_URL + 'show_post').then(onResponse).then(jsonPosts);
}






postShow();

//fetch('post_show.php').then(onResponse).then(jsonPosts);
