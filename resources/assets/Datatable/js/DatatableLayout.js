class DatatableLayout
{
    static fromDom(dom)
    {
        switch (dom) {
            case "t":
            case "rt":
            case "tr":                
                return { topStart: null,          topEnd: null,       bottomStart: null,    bottomEnd: null       };
            case "rti":                
            case "ti":                
                return { topStart: null,          topEnd: null,       bottomStart: 'info',  bottomEnd: null       };
            case "rtip":
            case "tip":
                return { topStart: null,          topEnd: null,       bottomStart: 'info',  bottomEnd: 'paging'   };
            case "rtp":
            case "tp":
                return { topStart: null,          topEnd: null,       bottomStart: null,    bottomEnd: 'paging'   };
            case "ltp":
                return { topStart: 'pageLength',  topEnd: 'search',   bottomStart: null,    bottomEnd: 'paging'  };
            case "lfrtip":
            default:
                return { topStart: 'pageLength',  topEnd: 'search',   bottomStart: 'info',   bottomEnd: 'paging'  };
        }
    }
}