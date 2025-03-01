<template>
  <div class="card">
    <el-form :model="filters" label-width="100px">
      <el-row gutter={20}>
        <el-col :span="12">
          <el-form-item label="Name">
            <el-input v-model="filters.name" placeholder="Property name"></el-input>
          </el-form-item>
        </el-col>

        <el-col :span="12">
          <el-form-item label="Bedrooms">
            <el-input v-model="filters.bedrooms" type="number" placeholder="Number of bedrooms"></el-input>
          </el-form-item>
        </el-col>
      </el-row>

      <el-row gutter={20}>
        <el-col :span="12">
          <el-form-item label="Bathrooms">
            <el-input v-model="filters.bathrooms" type="number" placeholder="Number of bathrooms"></el-input>
          </el-form-item>
        </el-col>

        <el-col :span="12">
          <el-form-item label="Storeys">
            <el-input v-model="filters.storeys" type="number" placeholder="Number of storeys"></el-input>
          </el-form-item>
        </el-col>
      </el-row>

      <el-row gutter={20}>
        <el-col :span="12">
          <el-form-item label="Garages">
            <el-input v-model="filters.garages" type="number" placeholder="Number of garages"></el-input>
          </el-form-item>
        </el-col>

        <el-col :span="12">
          <el-form-item label="Min Price">
            <el-input v-model="filters.priceMin" type="number" placeholder="Min price"></el-input>
          </el-form-item>
        </el-col>
      </el-row>

      <el-row gutter={20}>
        <el-col :span="12">
          <el-form-item label="Max Price">
            <el-input v-model="filters.priceMax" type="number" placeholder="Max price"></el-input>
          </el-form-item>
        </el-col>
      </el-row>

      <el-form-item>
        <el-button type="primary" @click="getProperties">Search</el-button>
        <el-button @click="resetFilters" style="margin-left: 10px;">Reset Filters</el-button>
      </el-form-item>
    </el-form>

    <div v-if="properties.length > 0">
      <el-table :data="properties" style="width: 100%">
        <el-table-column label="ID" prop="id"></el-table-column>
        <el-table-column label="Name" prop="name"></el-table-column>
        <el-table-column label="Bedrooms" prop="bedrooms"></el-table-column>
        <el-table-column label="Bathrooms" prop="bathrooms"></el-table-column>
        <el-table-column label="Storeys" prop="storeys"></el-table-column>
        <el-table-column label="Garages" prop="garages"></el-table-column>
        <el-table-column label="Price" prop="price"></el-table-column>
      </el-table>
    </div>

    <div v-else>
      <p>No properties found</p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const filters = ref({
  name: null,
  bedrooms: null,
  bathrooms: null,
  storeys: null,
  garages: null,
  priceMin: null,
  priceMax: null,
})

const properties = ref([])

const getProperties = async () => {
  try {
    const response = await axios.get(`${import.meta.env.VITE_API_URL}/properties`, {
      params: {
        name: filters.value.name,
        bedrooms: filters.value.bedrooms,
        bathrooms: filters.value.bathrooms,
        storeys: filters.value.storeys,
        garages: filters.value.garages,
        priceMin: filters.value.priceMin,
        priceMax: filters.value.priceMax,
      }
    })
    properties.value = response.data.data
  } catch (error) {
    console.error('Error fetching properties:', error)
  }
}

const resetFilters = () => {
  filters.value = {
    name: null,
    bedrooms: null,
    bathrooms: null,
    storeys: null,
    garages: null,
    priceMin: null,
    priceMax: null,
  }
  getProperties()
}

onMounted(() => {
  getProperties()
})
</script>

<style scoped>
.card {
  margin-top: 20px;
}

.el-row {
  margin-bottom: 10px;
}
</style>
