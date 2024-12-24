import './bootstrap';
import "flyonui/flyonui"

document.addEventListener("livewire:navigated", () => {

    window.HSStaticMethods.autoInit();

});
