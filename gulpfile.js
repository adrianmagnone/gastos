const { parallel, src, dest } = require('gulp');
var concat = require("gulp-concat");

var path = {
    node: "node_modules",
    res_css: "resources/css",
    res_js: "resources/js",
    js: "public/js/",
    css: "public/css/"
}

//JQUERY BOOTSTRAP BUNDLE
function bundleJQuery()
{
	return src([
          `${path.node}/jquery/dist/jquery.min.js`
     ])
     .pipe(concat("jquery.min.js"))
     .pipe(dest(path.js));
}


function bundleTabler()
{
     src([
          `${path.res_css}/tabler/tabler.css`,
          `${path.res_css}/tabler/tabler-vendors.css`,
          `${path.res_css}/tabler/demo.css`,
          `${path.res_css}/tabler/litepicker.css`,
          `${path.res_css}/megaTabler.css`
     ])
     .pipe(concat("tabler.min.css"))
     .pipe(dest(path.css));

     return src([
          `${path.res_js}/tabler/tabler.js`,
          `${path.res_js}/tabler/demo-theme.js`,
          `${path.res_js}/tabler/tom-select.popular.js`,
          `${path.res_js}/tabler/litepicker.js`,
          `${path.node}/imask/dist/imask.min.js`,
          `${path.node}/jquery-mask-plugin/dist/jquery.mask.min.js`
     ])
     .pipe(concat("tabler.min.js"))
     .pipe(dest(path.js));
}

function bundleMain()
{
     return src([
          `${path.res_js}/main.js`,
          `${path.res_js}/main_xhr.js`
     ])
     .pipe(concat("main.min.js"))
     .pipe(dest(path.js));
}


function bundleCode()
{
     return src([
          `${path.res_js}/contaduria/comprobante.js`
     ])
     .pipe(concat("code.min.js"))
     .pipe(dest(path.js));
}

// function bundleBootstrap()
// {
// 	return src([
//           `${path.insp}/app/popper.min.js`,
//           `${path.insp}/app/bootstrap.js`
//      ])
//      .pipe(concat("bootstrap.min.js"))
//      .pipe(dest(path.js));
// }

// DATATABLES
function bundleDataTables()
{
     src([
          `${path.node}/datatables.net/js/jquery.dataTables.min.js`,
          `${path.res_js}/MegaDatatable.js`,
          `${path.res_js}/renderTableCell.js`
     ])
     .pipe(concat("datatables.min.js"))
     .pipe(dest(path.js));


     src([
          `${path.res_js}/MegaSearch.js`,
          `${path.res_js}/MegaSearchOptions.js`
     ])
     .pipe(concat("search.min.js"))
     .pipe(dest(path.js));


     return src([
          `${path.node}/datatables.net-dt/css/jquery.dataTables.min.css`,
          `${path.res_css}/dataTable.css`
     ])
     .pipe(concat("datatables.min.css"))
     .pipe(dest(path.css));
}

function bundleCalendar()
{
     src([
          `${path.node}/flatpickr/dist/flatpickr.min.css`,
          `${path.res_css}/flatpick.css`,
     ])
     .pipe(concat("calendar.min.css"))
     .pipe(dest(path.css));

     return src([
          `${path.node}/flatpickr/dist/flatpickr.min.js`,
          `${path.node}/flatpickr/dist/l10n/es.js`,
          `${path.res_js}/wraps/wrap-calendar.js`,
     ])
     .pipe(concat("calendar.min.js"))
     .pipe(dest(path.js));
}

function bundleWraps()
{
     return src([
          `${path.res_js}/wraps/wrap-calendar.js`,
          `${path.res_js}/wraps/wrap-check.js`,
          `${path.res_js}/wraps/wrap-dropdown.js`,
          `${path.res_js}/wraps/wrap-select.js`,
          `${path.res_js}/wraps/wrap-text.js`
     ])
     .pipe(concat("wraps.min.js"))
     .pipe(dest(path.js));
}

exports.bundle = parallel(
	bundleJQuery,
     bundleTabler,
     bundleMain,
     // bundleBootstrap,
     bundleDataTables,
     // bundleCalendar,
     bundleWraps,
     bundleCode
);


