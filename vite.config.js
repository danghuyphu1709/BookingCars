import { defineConfig } from 'vite'
import { resolve } from 'path'; // Import hàm resolve từ module path
export default defineConfig({
  resolve: {
    alias: {
      '@' : resolve(__dirname,'src')
    },
  },
})
