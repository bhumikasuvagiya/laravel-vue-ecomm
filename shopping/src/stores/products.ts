import { defineStore } from 'pinia';

const fakeStoreUrl = import.meta.env.VITE_SERVER_URL;

export interface Product {
  product_id: number;
  product_name: string;
  amount: number;
  description: string;
  // category: string;
  product_image: string;
  
}

interface ProductState {
  items: Record<string, Product>;
  ids: number[];
  sortBykey: string,
  page : number,
}

export const useProductStore = defineStore({
  id: 'products',

  state: (): ProductState => ({
    items: {},
    ids: [],
    sortBykey: '',
    page : 0,
  }),

  getters: {
    list(): Product[] {
      return this.ids.map((i) => this.items[i]);
    },

    loaded(): boolean {
      return this.ids.length > 0;
    },
    count(): number {
      return this.ids.length;
    },

  },

  actions: {
    async fetchAll() {
      // alert(page); 
      // this.page  = page;
      // // console.log();
      
      // if(!page){
      //   this.page = 1;
      // }
      // if (this.loaded) return;

      const res = await fetch(`${fakeStoreUrl}/products`);
      const data: Product[] = await res.json();
      // console.log(data);
      
      this.ids = data.map((product) => {
        this.items[product.product_id] = product;
        return product.product_id;
      });
    },
    async fetchAllSubcategoryProduct(subcategory_id : number) {
      // if (this.loaded) return;

      const res = await fetch(`${import.meta.env.VITE_SERVER_URL}/subcategory/${subcategory_id}`);
      const data: Product[] = await res.json();
      this.ids = data.map((product) => {
        this.items[product.product_id] = product;
        return product.product_id;
      });

    },
    async fetchAllCategoryProduct(category_id : number) {
      // if (this.loaded) return;

      const res = await fetch(`${import.meta.env.VITE_SERVER_URL}/category-products/${category_id}`);
      const data: Product[] = await res.json();
      this.ids = data.map((product) => {
        this.items[product.product_id] = product;
        return product.product_id;
      });

    },
    async sortByPrice(key : string){
      // if (this.loaded) return;
      this.sortBykey = key;
      if(key == ''){
        this.sortBykey = 'all';
      }
      // const url = `${fakeStoreUrl}/products/${sortingKey}`;
      const res = await fetch(`${fakeStoreUrl}/products/${this.sortBykey}`);
      const data: Product[] = await res.json();
      
      this.ids = data.map((product) => {
        this.items[product.product_id] = product;
        return product.product_id;
      });
    }
  },
});
