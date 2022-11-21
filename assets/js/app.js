new Vue({
    el: '#app',
    data: {
        showBurger: false,
        showPreview: false,
        activeImg: 0,
        listData: []
    },
    watch: {
        showPreview() {
            document.body.style.overflowY = this.showPreview ? "hidden" : "scroll"
        },
        listData() {
            if(this.listData.length !== 0) {
                const vm = this
                setTimeout(() => {
                    vm.renderMasonry()
                }, 100);
            }
        }
    },
    computed: {
        getSlug() {
            const slug = window.location.href.split('/')
            const lastSegment = slug.pop() || slug.pop(); 
            if(lastSegment.includes("editorial")) {
                return 'editorial'
            } else if(lastSegment.includes("sketchbook")) {
                return 'sketchbook'
            } else {
                return 'illustrations'
            }
        }
    },
    methods: {
        resizeMasonryItem(item){
            const grid = document.getElementsByClassName('masonry')[0],
                rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-row-gap')),
                rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
            const rowSpan = Math.ceil((item.querySelector('.masonry-content').getBoundingClientRect().height+rowGap)/(rowHeight+rowGap));
            item.style.gridRowEnd = 'span '+rowSpan;
            item.querySelector('.masonry-content').style.height = rowSpan * 10 + "px";
        },
        resizeAllMasonryItems(){
            var allItems = document.getElementsByClassName('masonry-item');
            for(var i=0;i>allItems.length;i++){
              this.resizeMasonryItem(allItems[i]);
            }
        },
        renderMasonry() {
            const vm = this
            const allItems = document.getElementsByClassName('masonry-item');
            for(let i=0;i<allItems.length;i++){
              imagesLoaded( allItems[i], function(instance) {
                const item = instance.elements[0];
                vm.resizeMasonryItem(item);
              } );
            }
        },
        async fetchData(category) {
            const vm = this
            const body = {
                'category' : category
            }
            await axios
              .post('/arindjo/wp-json/arindjo/v1/list/', body)
              .then(({ data }) => {
                vm.listData = data
                console.log(data)
              })
              .catch( error => console.log(error))
        }
    },
    mounted(){
        this.fetchData(this.getSlug)
        this.$nextTick(() => {
            const vm = this
            var masonryEvents = ['load', 'resize'];
            masonryEvents.forEach( function(event) {
                window.addEventListener(event, vm.resizeAllMasonryItems);
            } );
        });
    },
})