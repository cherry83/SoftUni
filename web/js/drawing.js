var drawingApp = (function () {

    "use strict";

    var contexts = {},
        context,
        canvasWidth = 720,
        canvasHeight = 460,

        colors = [
            {r: 250, g: 204, b: 22},
            {r: 247, g: 103, b: 33},
            {r: 250, g: 169, b: 116},
            {r: 244, g: 134, b: 179},
            {r: 219, g: 39, b: 47},
            {r: 36, g: 66, b: 126},
            {r: 53, g: 182, b: 239},
            {r: 75, g: 158, b: 70},
            {r: 31, g: 75, b: 58},
            {r: 59, g: 53, b: 113},
            {r: 100, g: 81, b: 77},
            {r: 37, g: 37, b: 37}
        ],

        outlineImage = new Image(),

        crayonImage = new Image(),
        markerImage = new Image(),
        eraserImage = new Image(),
        bucketImage = new Image(),

        backgroundImage = new Image(),
        crayonTextureImage = new Image(),

        clickX = [],
        clickY = [],
        clickColor = [],
        clickTool = [],
        clickSize = [],
        clickDrag = [],

        paint = false,

        curColor = colors[0],
        curTool = "crayon",
        curSize = "normal",

        mediumImageWidth = 46,

        drawingAreaX = 139,
        drawingAreaY = 138,
        drawingAreaWidth = 394,
        drawingAreaHeight = 316,

        toolHotspotStartX = drawingAreaX + drawingAreaWidth,
        toolHotspotStartY = 290,

        totalLoadResources = 6,

        curLoadResNum = 0,

        colorLayerData,
        outlineLayerData,

        clearCanvas = function () {
            context.clearRect(0, 0, canvasWidth, canvasHeight);
        },

        // Redraws the canvas.
        redraw = function () {

            var locX,
                locY,
                Rad,
                radius,
                i,
                selected,

                drawBucked = function (x, y, color, selected) {
                    var dy = 0;
                    if (selected) {
                        y -= 20;
                        dy = 10;
                    }
                    context.save();
                    context.translate(x + 24, y + 105);
                    context.scale(1, 0.35);
                    context.beginPath();
                    context.arc(0, 0, 12, 0, Math.PI * 2, true);
                    context.restore();
                    context.closePath();
                    context.fillStyle = "rgb(" + color.r + "," + color.g + "," + color.b + ")";
                    context.fill();

                    context.beginPath();
                    context.arc(x + 23, y + 126, 8, 0, Math.PI * 2, true);
                    context.closePath();
                    context.fillStyle = "rgb(" + color.r + "," + color.g + "," + color.b + ")";
                    context.fill();

                    context.drawImage(bucketImage, 0, 0, mediumImageWidth, 83 + dy, x + 2, y + 55, mediumImageWidth - 10, 83 + dy);
                },

                drawCrayon = function (x, y, color, selected) {
                    var dy = 0;
                    if (selected) {
                        y -= 20;
                        dy = 20;
                    }
                    context.beginPath();
                    context.moveTo(x + 20, y + 80);
                    context.lineTo(x + 35, y + 115);
                    context.lineTo(x + 35, y + 135 + dy);
                    context.lineTo(x + 10, y + 135 + dy);
                    context.lineTo(x + 10, y + 115);
                    context.lineTo(x + 20, y + 80);
                    context.closePath();
                    context.fillStyle = "rgb(" + color.r + "," + color.g + "," + color.b + ")";
                    context.fill();

                    context.drawImage(crayonImage, 0, 0, mediumImageWidth - 5, 63 + dy, x + 2, y + 75, mediumImageWidth - 10, 63 + dy);
                },

                drawMarker = function (x, y, color, selected) {
                    var dy = 0;
                    if (selected) {
                        y -= 20;
                        dy = 20;
                    }
                    context.beginPath();
                    context.moveTo(x + 17, y + 90);
                    context.lineTo(x + 17, y + 97);
                    context.lineTo(x + 23, y + 97);
                    context.lineTo(x + 23, y + 85);
                    context.closePath();
                    context.fillStyle = "rgb(" + color.r + "," + color.g + "," + color.b + ")";
                    context.fill();
                    context.beginPath();
                    context.moveTo(x + 6, y + 122);
                    context.lineTo(x + 6, y + 135 + dy);
                    context.lineTo(x + 35, y + 135 + dy);
                    context.lineTo(x + 35, y + 122);
                    context.closePath();
                    context.fill();

                    context.drawImage(markerImage, 0, 0, mediumImageWidth, 63 + dy, x + 2, y + 75, mediumImageWidth - 12, 63 + dy);
                };

            // Make sure required resources are loaded before redrawing
            if (curLoadResNum < totalLoadResources) {
                return;
            }

            clearCanvas();

            if (curTool === "crayon") {
                var x = drawingAreaX + drawingAreaWidth + 5;
                var y = drawingAreaY + 70;
                context.beginPath();
                context.moveTo(x, y);
                context.lineTo(x + 50, y);
                context.lineTo(x + 50, y + 300);
                context.lineTo(x, y + 300);
                context.lineTo(x, y);
                context.closePath();
                context.fillStyle = "rgb(" + curColor.r + "," + curColor.g + "," + curColor.b + ")";
                context.fill();
                for (i = 0; i < 12; i++) {
                    selected = (curColor === colors[i]);
                    locX = i * 33;
                    locY = 0;
                    drawCrayon(drawingAreaX - 5 + locX, locY, colors[i], selected);
                }
            } else if (curTool === "marker") {
                var x = drawingAreaX + drawingAreaWidth + 55;
                var y = drawingAreaY + 70;
                context.beginPath();
                context.moveTo(x, y);
                context.lineTo(x + 50, y);
                context.lineTo(x + 50, y + 300);
                context.lineTo(x, y + 300);
                context.lineTo(x, y);
                context.closePath();
                context.fillStyle = "rgb(" + curColor.r + "," + curColor.g + "," + curColor.b + ")";
                context.fill();
                for (i = 0; i < 12; i++) {
                    selected = (curColor === colors[i]);
                    locX = i * 33;
                    locY = 0;
                    drawMarker(drawingAreaX - 5 + locX, locY, colors[i], selected);
                }
            } else if (curTool === "bucket") {
                var x = drawingAreaX + drawingAreaWidth + 110;
                var y = drawingAreaY + 70;
                context.beginPath();
                context.moveTo(x, y);
                context.lineTo(x + 60, y);
                context.lineTo(x + 60, y + 300);
                context.lineTo(x, y + 300);
                context.lineTo(x, y);
                context.closePath();
                context.fillStyle = "rgb(" + curColor.r + "," + curColor.g + "," + curColor.b + ")";
                context.fill();
                for (i = 0; i < 12; i++) {
                    selected = (curColor === colors[i]);
                    locX = i * 33;
                    locY = 0;
                    drawBucked(drawingAreaX - 5 + locX, locY, colors[i], selected);
                }
            }

            context.drawImage(backgroundImage, 0, 0, canvasWidth, canvasHeight);

            context.font = "14px Comic Sans MS";
            context.fillStyle = "rgb(" + colors[5].r + "," + colors[5].g + "," + colors[5].b + ")";
            context.fillText("Размери", 40, toolHotspotStartY - 50);
            context.fillText("Цветове", 300, 45);
            context.fillText("Инструменти", 600, toolHotspotStartY - 50);

            switch (curSize) {
                case "small":
                    locY = 320;
                    locX = 92;
                    Rad = 3;
                    break;
                case "normal":
                    locY = 349;
                    locX = 90;
                    Rad = 7;
                    break;
                case "large":
                    locY = 384;
                    locX = 87;
                    Rad = 13;
                    break;
                case "huge":
                    locY = 428;
                    locX = 84;
                    Rad = 17;
                    break;
                default:
                    break;
            }

            context.beginPath();
            context.arc(locX, locY, Rad, 0, Math.PI * 2, true);
            context.closePath();
            context.fillStyle = "rgb(" + curColor.r + "," + curColor.g + "," + curColor.b + ")";
            context.fill();

            if (curTool === "bucket") {

                contexts.drawing.putImageData(colorLayerData, 0, 0, 0, 0, drawingAreaWidth, drawingAreaHeight);
            } else {
                if (clickX.length) {

                    for (i = 0; i < clickX.length; i += 1) {

                        contexts.drawing.beginPath();

                        switch (clickSize[i]) {
                            case "small":
                                radius = 2;
                                break;
                            case "normal":
                                radius = 5;
                                break;
                            case "large":
                                radius = 10;
                                break;
                            case "huge":
                                radius = 20;
                                break;
                            default:
                                break;
                        }

                        if (clickDrag[i] && i) {
                            contexts.drawing.moveTo(clickX[i - 1], clickY[i - 1]);
                        } else {
                            contexts.drawing.moveTo(clickX[i] - 1, clickY[i]);
                        }
                        contexts.drawing.lineTo(clickX[i], clickY[i]);

                        if (curTool === "eraser") {
                            contexts.drawing.strokeStyle = 'white';
                        } else {
                            contexts.drawing.strokeStyle = "rgb(" + clickColor[i].r + ", " + clickColor[i].g + ", " + clickColor[i].b + ")";
                        }

                        contexts.drawing.lineCap = "round";
                        contexts.drawing.lineJoin = "round";
                        contexts.drawing.lineWidth = radius;
                        contexts.drawing.stroke();
                        contexts.drawing.closePath();
                    }
                    clearClick();
                }
            }

            if (curTool === "crayon") {
                contexts.texture.canvas.style.display = "block";
            } else {
                contexts.texture.canvas.style.display = "none";
            }
        },

        addClick = function (x, y, dragging) {

            clickX.push(x);
            clickY.push(y);
            clickTool.push(curTool);
            clickColor.push(curColor);
            clickSize.push(curSize);
            clickDrag.push(dragging);
        },

        clearClick = function () {

            clickX = [clickX[clickX.length - 1]];
            clickY = [clickY[clickY.length - 1]];
            clickTool = [clickTool[clickTool.length - 1]];
            clickColor = [clickColor[clickColor.length - 1]];
            clickSize = [clickSize[clickSize.length - 1]];
            clickDrag = [clickDrag[clickDrag.length - 1]];
        },

        matchOutlineColor = function (r, g, b, a) {

            return (r + g + b < 100 && a === 255);
        },

        matchStartColor = function (pixelPos, startR, startG, startB) {

            var r = outlineLayerData.data[pixelPos],
                g = outlineLayerData.data[pixelPos + 1],
                b = outlineLayerData.data[pixelPos + 2],
                a = outlineLayerData.data[pixelPos + 3];

            // If current pixel of the outline image is black
            if (matchOutlineColor(r, g, b, a)) {
                return false;
            }

            r = colorLayerData.data[pixelPos];
            g = colorLayerData.data[pixelPos + 1];
            b = colorLayerData.data[pixelPos + 2];

            // If the current pixel matches the clicked color
            if (r === startR && g === startG && b === startB) {
                return true;
            }

            // If current pixel matches the new color
            if (r === curColor.r && g === curColor.g && b === curColor.b) {
                return false;
            }

            return (Math.abs(r - startR) + Math.abs(g - startG) + Math.abs(b - startB) < 255);
        },

        colorPixel = function (pixelPos, r, g, b, a) {

            colorLayerData.data[pixelPos] = r;
            colorLayerData.data[pixelPos + 1] = g;
            colorLayerData.data[pixelPos + 2] = b;
            colorLayerData.data[pixelPos + 3] = a !== undefined ? a : 255;
        },

        floodFill = function (startX, startY, startR, startG, startB) {

            var newPos,
                x,
                y,
                pixelPos,
                reachLeft,
                reachRight,
                drawingBoundLeft = 0,
                drawingBoundTop = 0,
                drawingBoundRight = drawingAreaWidth - 1,
                drawingBoundBottom = drawingAreaHeight - 1,
                pixelStack = [[startX, startY]];

            while (pixelStack.length) {

                newPos = pixelStack.pop();
                x = newPos[0];
                y = newPos[1];

                // Get current pixel position
                pixelPos = (y * drawingAreaWidth + x) * 4;

                // Go up as long as the color matches and are inside the canvas
                while (y >= drawingBoundTop && matchStartColor(pixelPos, startR, startG, startB)) {
                    y -= 1;
                    pixelPos -= drawingAreaWidth * 4;
                }

                pixelPos += drawingAreaWidth * 4;
                y += 1;
                reachLeft = false;
                reachRight = false;

                // Go down as long as the color matches and in inside the canvas
                while (y <= drawingBoundBottom && matchStartColor(pixelPos, startR, startG, startB)) {
                    y += 1;

                    colorPixel(pixelPos, curColor.r, curColor.g, curColor.b);

                    if (x > drawingBoundLeft) {
                        if (matchStartColor(pixelPos - 4, startR, startG, startB)) {
                            if (!reachLeft) {
                                // Add pixel to stack
                                pixelStack.push([x - 1, y]);
                                reachLeft = true;
                            }
                        } else if (reachLeft) {
                            reachLeft = false;
                        }
                    }

                    if (x < drawingBoundRight) {
                        if (matchStartColor(pixelPos + 4, startR, startG, startB)) {
                            if (!reachRight) {
                                // Add pixel to stack
                                pixelStack.push([x + 1, y]);
                                reachRight = true;
                            }
                        } else if (reachRight) {
                            reachRight = false;
                        }
                    }

                    pixelPos += drawingAreaWidth * 4;
                }
            }
        },

        // Start painting with paint bucket tool starting from pixel specified by startX and startY
        paintAt = function (startX, startY) {
            console.log('start ' + startX + ' ' + startY)
            var pixelPos = (startY * drawingAreaWidth + startX) * 4,
                r = colorLayerData.data[pixelPos],
                g = colorLayerData.data[pixelPos + 1],
                b = colorLayerData.data[pixelPos + 2],
                a = colorLayerData.data[pixelPos + 3];

            if (r === curColor.r && g === curColor.g && b === curColor.b) {
                // Return because trying to fill with the same color
                return;
            }

            if (matchOutlineColor(r, g, b, a)) { // Return because clicked outline
                return;
            }
            console.log(r + ' ' + g + ' ' + b);
            floodFill(startX, startY, r, g, b);

            redraw();
        },

        // Add mouse and touch event listeners to the canvas
        createUserEvents = function () {

            var press = function (e) {
                    // Mouse down location

                    var sizeHotspotStartX,
                        rect = this.getBoundingClientRect(),
                        mouseX = (e.changedTouches ? e.changedTouches[0].pageX : e.pageX) - rect.left, //this.offsetLeft,
                        mouseY = (e.changedTouches ? e.changedTouches[0].pageY : e.pageY) - rect.top; //this.offsetTop;

                    if (mouseY < drawingAreaY - 10) { // Top of the drawing area
                        if (mouseX > drawingAreaX && mouseX < drawingAreaX + drawingAreaWidth && mouseY > drawingAreaY - 50) {
                            var colorIndex = ~~((mouseX - drawingAreaX) / 33);
                            curColor = colors[colorIndex];
                        }
                    } else {
                        if (mouseX > drawingAreaX + drawingAreaWidth) { // Right of the drawing area
                            if (mouseY > toolHotspotStartY && mouseX < toolHotspotStartX + 55) {
                                curTool = "crayon";
                            } else if (mouseY > toolHotspotStartY && mouseX < toolHotspotStartX + 100) {
                                curTool = "marker";
                            } else if (mouseX > toolHotspotStartX + 100) {
                                if (mouseY > toolHotspotStartY + 80) {
                                    if (curTool !== "bucket") {
                                        curTool = "bucket";
                                        colorLayerData = contexts.drawing.getImageData(0, 0, drawingAreaWidth, drawingAreaHeight);
                                    }
                                } else if (mouseY > toolHotspotStartY + 20) {
                                    curTool = "eraser";
                                }
                            }
                        } else if (mouseX > 30 && mouseX < 100) { // Left of the drawing area
                            sizeHotspotStartX = drawingAreaX + drawingAreaWidth;
                            if (mouseY > 315 && mouseY < 330) {
                                curSize = "small";
                            } else if (mouseY > 330 && mouseY < 365) {
                                curSize = "normal";
                            } else if (mouseY > 365 && mouseY < 405) {
                                curSize = "large";
                            } else if (mouseY > 405 && mouseY < 450) {
                                curSize = "huge";
                            }
                        }
                    }
                },

                drag = function (e) {

                    if (curTool !== "bucket") {
                        if (paint) {
                            var rect = this.getBoundingClientRect(),
                                mouseX = (e.changedTouches ? e.changedTouches[0].pageX : e.pageX) - rect.left, //this.offsetLeft,
                                mouseY = (e.changedTouches ? e.changedTouches[0].pageY : e.pageY) - rect.top; //this.offsetTop;

                            console.log("addClick(" + e.pageX + " - " + this.offsetLeft + "   " + drawingAreaX + ", " + e.pageY + " - " + drawingAreaY + ", true);");
                            addClick(mouseX - drawingAreaX, mouseY - drawingAreaY, true);
                            redraw();
                        }
                    }
                    // Prevent the whole page from dragging if on mobile
                    e.preventDefault();
                },

                release = function () {

                    if (curTool !== "bucket") {
                        paint = false;
                    }
                    redraw();
                },

                cancel = function () {
                    if (curTool !== "bucket") {
                        paint = false;
                    }
                },

                pressDrawing = function (e) {

                    // Mouse down location
                    var rect = this.getBoundingClientRect(),
                        mouseX = ~~((e.changedTouches ? e.changedTouches[0].pageX : e.pageX) - rect.left), //this.offsetLeft,
                        mouseY = ~~((e.changedTouches ? e.changedTouches[0].pageY : e.pageY) - rect.top); //this.offsetTop;

                    if (curTool === "bucket") {
                        // Mouse click location on drawing area
                        paintAt(mouseX, mouseY);
                    } else {
                        paint = true;
                        console.log("addClick(" + mouseX + ", " + mouseY + ", true);");
                        addClick(mouseX, mouseY, false);
                    }

                    redraw();
                },

                dragDrawing = function (e) {

                    var rect = this.getBoundingClientRect(),
                        mouseX = (e.changedTouches ? e.changedTouches[0].pageX : e.pageX) - rect.left, //this.offsetLeft,
                        mouseY = (e.changedTouches ? e.changedTouches[0].pageY : e.pageY) - rect.top; //this.offsetTop;

                    if (curTool !== "bucket") {
                        if (paint) {
                            addClick(mouseX, mouseY, true);
                            redraw();
                        }
                    }

                    // Prevent the whole page from dragging if on mobile
                    e.preventDefault();
                },

                releaseDrawing = function () {

                    if (curTool !== "bucket") {
                        paint = false;
                        redraw();
                    }
                },

                cancelDrawing = function () {
                    if (curTool === "bucket") {
                        paint = false;
                    }
                };

            // Add mouse event listeners to canvas element
            context.canvas.addEventListener("mousedown", press, false);
            context.canvas.addEventListener("mousemove", drag, false);
            context.canvas.addEventListener("mouseup", release);
            context.canvas.addEventListener("mouseout", cancel, false);

            // Add touch event listeners to canvas element
            context.canvas.addEventListener("touchstart", press, false);
            context.canvas.addEventListener("touchmove", drag, false);
            context.canvas.addEventListener("touchend", release, false);
            context.canvas.addEventListener("touchcancel", cancel, false);

            // Add mouse event listeners to canvas element
            contexts.outline.canvas.addEventListener("mousedown", pressDrawing, false);
            contexts.outline.canvas.addEventListener("mousemove", dragDrawing, false);
            contexts.outline.canvas.addEventListener("mouseup", releaseDrawing);
            contexts.outline.canvas.addEventListener("mouseout", cancelDrawing, false);

            // Add touch event listeners to canvas element
            contexts.outline.canvas.addEventListener("touchstart", pressDrawing, false);
            contexts.outline.canvas.addEventListener("touchmove", dragDrawing, false);
            contexts.outline.canvas.addEventListener("touchend", releaseDrawing, false);
            contexts.outline.canvas.addEventListener("touchcancel", cancelDrawing, false);
        },

        // Calls the redraw function after all neccessary resources are loaded.
        resourceLoaded = function () {

            curLoadResNum += 1;
            if (curLoadResNum === totalLoadResources) {
                redraw();
                createUserEvents();
            }
        },

        adjustImage = function (iArray) {
            var imageData = iArray.data;
            for (var i = 0; i < imageData.length; i += 4) {
                if (imageData[i] > 252 && imageData[i + 1] > 252 && imageData[i + 2] > 252) {
                    imageData[i + 3] = 0;
                }
            }
            return iArray;
        },

        init = function (outline) {

            var canvas;

            canvas = document.createElement('canvas');
            canvas.setAttribute('width', canvasWidth);
            canvas.setAttribute('height', canvasHeight);
            canvas.setAttribute('id', 'interface');
            document.getElementById('canvasDiv').appendChild(canvas);
            if (typeof G_vmlCanvasManager !== "undefined") {
                canvas = G_vmlCanvasManager.initElement(canvas);
            }
            context = canvas.getContext("2d");


            canvas = document.createElement('canvas');
            canvas.setAttribute('width', drawingAreaWidth);
            canvas.setAttribute('height', drawingAreaHeight);
            canvas.setAttribute('id', 'drawing');
            canvas.style.marginLeft = drawingAreaX + "px";
            canvas.style.marginTop = drawingAreaY + "px";
            document.getElementById('canvasDiv').appendChild(canvas);
            if (typeof G_vmlCanvasManager !== "undefined") {
                canvas = G_vmlCanvasManager.initElement(canvas);
            }
            contexts.drawing = canvas.getContext("2d");

            canvas = document.createElement('canvas');
            canvas.setAttribute('width', drawingAreaWidth);
            canvas.setAttribute('height', drawingAreaHeight);
            canvas.setAttribute('id', 'texture');
            canvas.style.marginLeft = drawingAreaX + "px";
            canvas.style.marginTop = drawingAreaY + "px";
            document.getElementById('canvasDiv').appendChild(canvas);
            if (typeof G_vmlCanvasManager !== "undefined") {
                canvas = G_vmlCanvasManager.initElement(canvas);
            }
            contexts.texture = canvas.getContext("2d");

            canvas = document.createElement('canvas');
            canvas.setAttribute('width', drawingAreaWidth);
            canvas.setAttribute('height', drawingAreaHeight);
            canvas.setAttribute('id', 'outline');
            canvas.style.marginLeft = drawingAreaX + "px";
            canvas.style.marginTop = drawingAreaY + "px";
            document.getElementById('canvasDiv').appendChild(canvas);
            if (typeof G_vmlCanvasManager !== "undefined") {
                canvas = G_vmlCanvasManager.initElement(canvas);
            }
            contexts.outline = canvas.getContext("2d");

            // Load resources
            backgroundImage.onload = resourceLoaded;
            backgroundImage.src = "/images/background.png";

            bucketImage.onload = resourceLoaded;
            bucketImage.src = "/images/bucket-outline.png";

            crayonImage.onload = resourceLoaded;
            crayonImage.src = "/images/crayon-outline.png";

            crayonTextureImage.onload = function () {
                contexts.texture.drawImage(crayonTextureImage, 0, 0, drawingAreaWidth, drawingAreaHeight);
                resourceLoaded();
            };
            crayonTextureImage.src = "/images/crayon-texture.png";

            eraserImage.onload = resourceLoaded;
            eraserImage.src = "/images/eraser-outline.png";

            markerImage.onload = resourceLoaded;
            markerImage.src = "/images/marker-outline.png";

            outlineImage.onload = function () {

                contexts.outline.drawImage(outlineImage, 0, 0, drawingAreaWidth, drawingAreaHeight);

                var imgData = contexts.outline.getImageData(0, 0, drawingAreaWidth, drawingAreaHeight);
                contexts.outline.putImageData(adjustImage(imgData), 0, 0);

                // Test for cross origin security error (SECURITY_ERR: DOM Exception 18)
                try {
                    outlineLayerData = contexts.outline.getImageData(0, 0, drawingAreaWidth, drawingAreaHeight);
                    colorLayerData = contexts.drawing.getImageData(0, 0, drawingAreaWidth, drawingAreaHeight);
                } catch (ex) {
                    //window.alert("Application cannot be run locally. Please run on a server.");
                    //return;
                }

                resourceLoaded();
            };
            outlineImage.src = "/outlines/" + outline;
        };

    return {
        init: init
    };
}());