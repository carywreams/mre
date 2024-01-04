/*
 * We know that the riemann.prc has exactly one mesh, so get it by taking
 * the first mesh from the scene.
 */
var mesh = scene.meshes.getByIndex(0);

/*
 * To get the animation play button for a PRC file it is sufficient to
 * implement a TimeEventHandler object.
 */
myTimeHandler = new TimeEventHandler();
myTimeHandler.onEvent = function(event)
{
    mesh.transform.rotateAboutZInPlace(0.2);
}

runtime.addEventHandler(myTimeHandler);

scene.lightScheme=scene.LIGHT_MODE_DAY;
scene.update();