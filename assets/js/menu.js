function openMenuPanels(panelElement) {
    if (panelElement) {
        panelElement.style.display = "block";
    }
}

function closePanel(panelElement) {
    if (panelElement) {
        panelElement.style.display = "none";
        
        // // Panel kapatıldığında ana içerik alanını sıfırla
        // if (mainContentArea) {
        //     mainContentArea.style.marginLeft = "";
        //     mainContentArea.style.marginRight = "";
        //     mainContentArea.style.marginTop = "";
        //     mainContentArea.style.marginBottom = "";
        //     mainContentArea.style.width = "";
        //     mainContentArea.style.height = "";
        // }
    }
}