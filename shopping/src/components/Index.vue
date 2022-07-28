
<template>
<div>
  <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat" v-for="category in categoryList" :key="category.category_id">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="img/featured/feature-1.jpg">
                           <img class="featured__item__pic set-bg" :src="'/assets/'+category.category_image" />
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">{{ category.category_name }}</a></h6>
                        </div>
                    </div>
                </div>
</div>
</template>
<script>

export default {
    name: "Index",
    data() {
        return {
            categoryList: [],
        }
    },
    mounted() {
        this.getList();
        // console.log(this.getList());
    },
    methods: {
        getList() {
            this.axios.get('http://localhost.onlineorder.com/api/category').then(response => {
                    this.categoryList = response.data;
                    console.log(response.data);
                })
                .catch(e => {
                    console.log(e);
                });
        }
    },
    getImage(imagePath) {
        console.log(imagePath);
        return require(imagePath);
    }
}
</script>
