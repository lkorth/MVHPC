// wait to load viewer till page load
$(window).load(function() {
  initialize();
});

// initialize PDF variables
var pdfDoc = null,
  pageNum,
  scale,
  canvas,
  ctx;

// URL for the pdf file to load (dynamic in PHP)
// stored in a vars called pdfURL and pdfFile
function initialize() {

  // disable workers to avoid cross-origin issues
  PDFJS.disableWorker = true;

  // set the PDF variables, where to save PDF info
  pdfDoc = null,
    pageNum = 1,
    scale = 1.6,
    canvas = document.getElementById('pdf'),
    ctx = canvas.getContext('2d');

  // asynchronously download PDF as an ArrayBuffer
  PDFJS.getDocument(pdfURL).then(function getPdfHelloWorld(_pdfDoc) {
    pdfDoc = _pdfDoc;
    renderPage(pageNum);
  });
}

// generate one page at a time to display
function renderPage(num) {
  // using promise to fetch the page
  pdfDoc.getPage(num).then(function(page) {
    var viewport = page.getViewport(scale);
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    // render PDF page into canvas context
    var renderContext = {
      canvasContext: ctx,
      viewport: viewport
    };
    page.render(renderContext);
  });

  // update page counters
  document.getElementById('pdf-page-num').value = pageNum;
  document.getElementById('pdf-page-count').textContent = pdfDoc.numPages;
}

// go to previous page
function goPrevious() {
  if (pageNum <= 1)
    return;
  pageNum--;
  renderPage(pageNum);
}

// go to next page
function goNext() {
  if (pageNum >= pdfDoc.numPages)
    return;
  pageNum++;
  renderPage(pageNum);
}

// go to designated page
function goToPage(num) {
  if (pageNum == num)
    return;
  pageNum = num;
  renderPage(pageNum);
}

// download the current PDF
function download() {
  window.open(pdfURL, '_parent');
}

// open the current PDF in a new window with the fullscreen viewer
function fullscreen() {
  window.open('fullscreen/', '_blank');
}
