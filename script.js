const banner2 = document.querySelector('.banner2');
const banner = document.querySelector('.banner');

window.addEventListener('scroll', () => {
  const scrollTop = window.scrollY;
  const bannerHeight = banner.offsetHeight;

  let opacity = (scrollTop / bannerHeight) * 2; // mais rápido
  if(opacity > 1) opacity = 1;

  banner2.style.opacity = opacity;
});
