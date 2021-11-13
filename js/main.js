// jQuery(document).ready(function($)
// {
//     //FIXED HEADER
//     window.onscroll = function() 
//     {
//         if(window.pageYOffset > 140) {
//             $('#header').addClass("active");
//         } else {
//             $('#header').removeClass("active");
//         }
//     };

//     $(".owl-carousel").owlCarousel({
//         loop: true,
//         margin: 30,
//         autoplay: false,
//         autoplayTimeout: 6000,
//         dots: true,
//         lazyLoad: true,
//         nav: false,
//         responsive: {
//         0: {
//             items: 1,
//         },
//         600: {
//             items: 1,
//         },
//         1000: {
//             items: 2,
//         },
//         },
//     });
    
// });




function mostrarOcultarSenha()
{
    var senha=document.getElementById("senha");
    if(senha.type=="password"){
        senha.type="text";
    } else {
        senha.type="password";
    }
}

function openNav(){
    document.getElementById("sidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

function closeNav(){
    document.getElementById("sidenav").style.width = "0px";
    document.getElementById("main").style.marginLeft = "0px";
}

