const { parallel, src, dest } = require('gulp');
var concat   = require("gulp-concat");
var cleanCss = require("gulp-clean-css");


const path = {
    node: "node_modules",
    res_css: "resources/css",
    res_js: "resources/js",
    assets: "resources/assets",
    js: "public/js/",
    css: "public/css/"
}

const files = {
     jsJQuery: [
          `${path.node}/jquery/dist/jquery.min.js`
     ],
     cssTabler: [
          `${path.res_css}/tabler/tom-select.css`,
          `${path.res_css}/tabler/tabler.css`,
          `${path.res_css}/tabler/tabler-vendors.css`,
          `${path.res_css}/tabler/tabler-themes.css`,
          `${path.res_css}/tabler/demo.css`,
          `${path.res_css}/tabler/litepicker.css`,
          `${path.res_css}/megaTabler.css`
     ],
     jsTabler: [
          `${path.res_js}/tabler/tabler.js`,
          `${path.res_js}/tabler/tabler-theme.js`,
          `${path.res_js}/tabler/tom-select.popular.js`,
          `${path.res_js}/tabler/litepicker.js`,
          `${path.node}/imask/dist/imask.min.js`,
          `${path.node}/jquery-mask-plugin/dist/jquery.mask.min.js`
     ],
     jsDatatable: [
          `${path.node}/datatables.net/js/jquery.dataTables.min.js`,
          `${path.assets}/Datatable/js/OwnDatatable.js`,
          `${path.res_js}/renderTableCell.js`
     ],
     cssDatatable: [
          `${path.node}/datatables.net-dt/css/jquery.dataTables.min.css`,
          `${path.res_css}/dataTable.css`
     ],
     jsMain: [
          `${path.res_js}/main.js`,
          `${path.assets}/OwnMain/js/xhr.js`
     ],
     jsSearch: [
          `${path.assets}/OwnSearch/OwnSearch.js`
     ],
     jsWrap: [
          `${path.assets}/OwnWraps/wrapCalendar.js`,
          `${path.assets}/OwnWraps/wrapCheck.js`,
          `${path.assets}/OwnWraps/wrapDropdown.js`,
          `${path.assets}/OwnWraps/wrapMoney.js`,
          `${path.assets}/OwnWraps/wrapPeriodo.js`,
          `${path.assets}/OwnWraps/wrapSelect.js`,
          `${path.assets}/OwnWraps/wrapSelectSearch.js`,
          `${path.assets}/OwnWraps/wrapSelectTag.js`,
          `${path.assets}/OwnWraps/wrapSeveralSelect.js`,
          `${path.assets}/OwnWraps/wrapText.js`,
          `${path.assets}/OwnWraps/wrapTextMask.js`
     ]
}

//JQUERY BOOTSTRAP BUNDLE
function bundleJQuery()
{
	return src(files.jsJQuery)
     .pipe(concat("jquery.min.js"))
     .pipe(dest(path.js));
}

function distJQuery()
{
	return src(files.jsJQuery)
     .pipe(concat("jquery.min.js"))
     .pipe(dest(path.js));
}

function bundleTabler()
{
     src(files.cssTabler)
     .pipe(concat("tabler.min.css"))
     .pipe(cleanCss())
     .pipe(dest(path.css));

     return src(files.jsTabler)
     .pipe(concat("tabler.min.js"))
     .pipe(dest(path.js));
}

function bundleMain()
{
     return src(files.jsMain)
     .pipe(concat("main.min.js"))
     .pipe(dest(path.js));
}

function bundleDataTables()
{
     src(files.jsDatatable)
     .pipe(concat("datatables.min.js"))
     .pipe(dest(path.js));


     src(files.jsSearch)
     .pipe(concat("search.min.js"))
     .pipe(dest(path.js));


     return src(files.cssDatatable)
     .pipe(concat("datatables.min.css"))
     .pipe(dest(path.css));
}

function bundleWraps()
{
     return src(files.jsWrap)
     .pipe(concat("wraps.min.js"))
     .pipe(dest(path.js));
}

exports.bundle = parallel(
	bundleJQuery,
     bundleTabler,
     bundleMain,
     bundleDataTables,
     bundleWraps
);
