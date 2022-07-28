import { defineStore } from 'pinia';

const fakeStoreUrl = import.meta.env.VITE_SERVER_URL;

export interface Category {
  category_id: number;
  category_name: string;
  category_image: string;
}

interface CategoryState {
  items: Record<string, Category>;
  ids: number[];
}

export const useCategoryStore = defineStore({
  id: 'categories',

  state: (): CategoryState => ({
    items: {},
    ids: [],
  }),

  getters: {
    list(): Category[] {
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
      if (this.loaded) return;

      const res = await fetch(`${fakeStoreUrl}/category`);
      
      const data: Category[] = await res.json();
      this.ids = data.map((category) => {
        this.items[category.category_id] = category;
        return category.category_id;
      });
    },
    async fetchSubCategory() {
      // if (this.loaded) return;

    /*   const res = await fetch(`${fakeStoreUrl}/category`);
      
      const data: Category[] = await res.json();
      this.ids = data.map((category) => {
        this.items[category.category_id] = category;
        return category.category_id;
      }); */
      return 'hiii';

    },
  },
});
