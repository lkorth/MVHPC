// URL to the pdf file to load (dynamic in PHP)
var url = '../data/' + pdfFile + '.pdf';

// disable workers to avoid cross-origin issues
PDFJS.disableWorker = true;

// create the PDF variable, where to save PDF info
var pdfDoc = null,
  pageNum = 1,
  scale = 0.8,
  canvas = document.getElementById('pdf'),
  ctx = canvas.getContext('2d');

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
  window.open(url, '_parent');
}

// open the current PDF in a new window with the fullscreen viewer
function fullscreen() {
  window.open('pdf-viewer-fs.php?pdf=' + pdfFile, '_blank');
}

// asynchronously download PDF as an ArrayBuffer
PDFJS.getDocument(url).then(function getPdfHelloWorld(_pdfDoc) {
  pdfDoc = _pdfDoc;
  renderPage(pageNum);
});
