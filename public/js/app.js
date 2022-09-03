

$(document).ready(function(){
    //dropdown feature on click of the bars icon
    $(".toggler").click(function(){
        $(".dropdownContents").toggle();
    })

})


//for the random 5 characters generated for the shortened link
const shortenBtn = document.querySelector('.shorten');
var text = "";
         var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

         for (var i = 0; i < 5; i++)
             text += possible.charAt(Math.floor(Math.random() * possible.length));


//for the form validation
let input = document.querySelector('.invalidin');

function requiredIt(){
    if (input.value.length !== 0){
        document.querySelector('.invalidp').style.display = "none";
        input.classList.remove('invalidin');
    } else {
        document.querySelector('.invalidp').style.display = "block";
        input.classList.add('invalidin');
    }
}

// input.addEventListener('input', function(){
//     document.querySelector('.invalidp').style.display = "none";
//     input.classList.remove('invalidin');
// })


//events on click of the shorten it button
shortenBtn.addEventListener('click', function(event){
    event.preventDefault();
    let gottenLink;
    let value = document.getElementById("valueInput").value;
    const adcontainer = document.querySelector(".linkContainer");

        if(value.startsWith("https://")) {
            gottenLink = value;
        }
       else {
            gottenLink = "https://" + value;
        }
        //  document.querySelector(".getLink").innerHTML = gottenLink;
        //  document.querySelector(".linkgo").href = gottenLink;
        //  document.querySelector(".linkgo").innerHTML = "https://shortnow.com/" + text;


        //  to create elements
         const div1 = document.createElement('div');
         const div2 = document.createElement('div');
         const div3 = document.createElement('div');
         const div4 = document.createElement('div');
         const div5 = document.createElement('div');
         const div6 = document.createElement('div');
         const para = document.createElement('p');
         const btn = document.createElement('button');
         const link = document.createElement('a');

         // to append
         div1.appendChild(para);
         div4.appendChild(link);
         div5.appendChild(btn);
         div3.appendChild(div4);
         div3.appendChild(div5);
         div2.appendChild(div3);
         div6.appendChild(div1);
         div6.appendChild(div2);
         adcontainer.appendChild(div6);


         div6.classList.add('row');
         div1.classList.add('col');
         div1.classList.add('linkDiv');
         para.classList.add('mb-5');
         para.classList.add('getLink');
         div2.classList.add('col');
         div2.classList.add('linkDiv');
         div3.classList.add('row');
         div3.classList.add('mr-5');
         div4.classList.add('col-lg-9');
         div4.classList.add('col-sm-12');
         div4.classList.add('text-lg-center');
         link.classList.add('linkgo');
         div5.classList.add('col-lg-3');
         div5.classList.add('col-sm-12');
         div5.classList.add('mt-sm-3');
         btn.classList.add('copy');




         para.textContent = gottenLink;
         link.textContent = "https://shortnow.com/" + text;
         btn.textContent = "Copy";
         link.href = gottenLink;
         link.target = "_blank";

})




