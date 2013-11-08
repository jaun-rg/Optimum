/**
 * @author mangekyou
 */
function launchFullScreen(element) {
	
	if (element.requestFullScreen) {
		element.requestFullScreen();
	} else if (element.mozRequestFullScreen) {
		element.mozRequestFullScreen();
	} else if (element.webkitRequestFullScreen) {
		element.webkitRequestFullScreen();
	}
}

window.addEventListener('load', launchFullScreen(document.documentElement), false); 