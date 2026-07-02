/*=========================================
        GSAP HERO ENTRANCE
=========================================*/

window.addEventListener("load", () => {

    const tl = gsap.timeline({
        defaults: {
            ease: "power3.out"
        }
    });

    tl.from(".badge", {
        y: -40,
        opacity: 0,
        duration: .6
    })

    .from(".hero-content h4", {
        x: -60,
        opacity: 0,
        duration: .6
    }, "-=.3")

    .from(".hero-content h1", {
        x: -80,
        opacity: 0,
        duration: .8
    }, "-=.3")

    .from(".hero-content p", {
        y: 40,
        opacity: 0,
        duration: .6
    }, "-=.4")

    .from(".hero-buttons a", {
        y: 30,
        opacity: 0,
        duration: .5,
        stagger: .15
    }, "-=.3")

    .from(".feature", {
        y: 25,
        opacity: 0,
        duration: .4,
        stagger: .1
    }, "-=.2")

    .from(".jar", {
        x: 120,
        opacity: 0,
        scale: .85,
        duration: 1
    }, "-=1")

    .from(".leaf", {
        scale: 0,
        rotate: 180,
        opacity: 0,
        duration: .8,
        stagger: .2
    }, "-=.8")

    .from(".garlic, .chilli", {
        scale: 0,
        opacity: 0,
        duration: .6,
        stagger: .15
    }, "-=.5")

    .from(".mustard", {
        scale: 0,
        opacity: 0,
        duration: .3,
        stagger: .08
    }, "-=.4")

    .from(".spark", {
        scale: 0,
        opacity: 0,
        duration: .3,
        stagger: .1
    }, "-=.2");

});


/*=========================================
        CONTINUOUS FLOAT
=========================================*/

gsap.to(".jar",{

    y:-18,

    duration:2.8,

    repeat:-1,

    yoyo:true,

    ease:"sine.inOut"

});

gsap.to(".leaf1",{

    y:-18,

    rotate:-8,

    duration:3,

    repeat:-1,

    yoyo:true,

    ease:"sine.inOut"

});

gsap.to(".leaf2",{

    y:15,

    rotate:8,

    duration:4,

    repeat:-1,

    yoyo:true,

    ease:"sine.inOut"

});

gsap.to(".garlic",{

    y:-12,

    rotate:10,

    duration:3.5,

    repeat:-1,

    yoyo:true,

    ease:"sine.inOut"

});

gsap.to(".chilli",{

    y:-14,

    rotate:-8,

    duration:3,

    repeat:-1,

    yoyo:true,

    ease:"sine.inOut"

});


/*=========================================
        MUSTARD FLOAT
=========================================*/

document.querySelectorAll(".mustard").forEach((seed,index)=>{

    gsap.to(seed,{

        y:-40,

        x:index%2===0?20:-20,

        rotation:360,

        duration:5+index,

        repeat:-1,

        yoyo:true,

        ease:"none"

    });

});


/*=========================================
        SPARKLE EFFECT
=========================================*/

document.querySelectorAll(".spark").forEach((spark,index)=>{

    gsap.to(spark,{

        scale:1.4,

        opacity:1,

        duration:1,

        repeat:-1,

        yoyo:true,

        delay:index*.4

    });

});


/*=========================================
        MOUSE PARALLAX
=========================================*/

const hero=document.querySelector(".hero");

hero.addEventListener("mousemove",(e)=>{

    const x=(e.clientX/window.innerWidth-.5)*30;

    const y=(e.clientY/window.innerHeight-.5)*30;

    gsap.to(".jar",{

        x:x,

        y:y-15,

        duration:.8

    });

    gsap.to(".leaf1",{

        x:-x,

        y:-y,

        duration:1

    });

    gsap.to(".leaf2",{

        x:x,

        y:y,

        duration:1

    });

    gsap.to(".garlic",{

        x:x/2,

        y:y/2,

        duration:1

    });

    gsap.to(".chilli",{

        x:-x/2,

        y:-y/2,

        duration:1

    });

});


/*=========================================
        BUTTON HOVER
=========================================*/

document.querySelectorAll(".hero-buttons a").forEach(btn=>{

    btn.addEventListener("mouseenter",()=>{

        gsap.to(btn,{
            scale:1.05,
            duration:.3
        });

    });

    btn.addEventListener("mouseleave",()=>{

        gsap.to(btn,{
            scale:1,
            duration:.3
        });

    });

});


/*=========================================
        SCROLL PARALLAX
=========================================*/

window.addEventListener("scroll",()=>{

    const scroll=window.scrollY;

    gsap.to(".jar",{

        y:-18+(scroll*.15),

        duration:.5

    });

    gsap.to(".bg-gradient",{

        y:scroll*.2,

        duration:.5

    });

    gsap.to(".leaf1",{

        y:-(scroll*.08),

        duration:.5

    });

    gsap.to(".leaf2",{

        y:(scroll*.08),

        duration:.5

    });

});


/*=========================================
        SCROLL INDICATOR
=========================================*/

gsap.to(".scroll-down",{

    y:12,

    repeat:-1,

    yoyo:true,

    duration:1,

    ease:"power1.inOut"

});