import './inc/bootstrap';
import { createListingItem, openModal, statsModal, listingInfoModal } from './inc/helpers.js';
import { getListings, getModels, getModel, deleteListing } from './inc/data.js';

class App {
    constructor() {
        this.state = {
            category: 'phone',
            listings: [],
            models:[],
            selectedModel: null,
            listingsCategory: 1,
            currentListingData: null
        },

        this.pageBody = document.querySelector('body');
        this.pageLoader = document.querySelector('.loader');
        this.listingsContainer = document.querySelector('.listings');
        this.statsContainer = document.querySelector('.stats');
        this.filtersContainer = document.querySelector('.filters');
        this.modelsOptions = document.querySelector('#models');
        this.events();
    }

    events() {
        window.onload = this.initApp();
        document.addEventListener('click', this.handleClick);
        this.modelsOptions.addEventListener('change', this.getModelListings);
    }

    initApp = async () => {
        this.state.listings = await getListings();
        this.state.models = await getModels(this.state.listingsCategory);

        this.createModelOptions();

        for (let i = 0; i < this.state.listings.data.length; i++) {
            const itemElement = createListingItem(this.state.listings.data[i]);
            this.listingsContainer.appendChild(itemElement);
        }

        this.pageLoader.remove();
        this.pageBody.style.overflow = 'initial';
    }

    getModelListings = async (e) => {
        this.state.selectedModel = e.target.value;
        this.listingsContainer.classList.add('processing');
        
        if (this.state.selectedModel) {
            const modelListings = await getModel(this.state.selectedModel);
            this.listingsContainer.innerHTML = '';
            
            if (modelListings.data.length > 0) {
                for (let i = 0; i < modelListings.data.length; i++) {
                    const itemElement = createListingItem(modelListings.data[i]);
                    this.listingsContainer.appendChild(itemElement);
                }
                
            } else {
                this.listingsContainer.innerHTML = '<p>No results found</p>';
            }
            this.createResetButton(this.filtersContainer);
            this.listingsContainer.classList.remove('processing');
        }
    }

    createModelOptions() {
        const models = [...this.state.models].reverse();
        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = 'Select model';
        this.modelsOptions.appendChild(defaultOption);

        for (let i = 0; i < models.length; i++) {
            const modelOption = document.createElement('option');
            modelOption.value = models[i].id;
            modelOption.textContent = `${models[i].model_name}`;
            this.modelsOptions.appendChild(modelOption);
        }
    }

    handleClick = (e) => {
        if (e.target.id === 'reset') {
            this.state.selectedModel = null;
            e.target.remove();

            this.modelsOptions.value = '';
            
            this.listingsContainer.innerHTML = '';
            for (let i = 0; i < this.state.listings.data.length; i++) {
                const itemElement = createListingItem(this.state.listings.data[i]);
                this.listingsContainer.appendChild(itemElement);
            }
        }

        if(e.target.id === 'best-profit') {
            const listings = document.querySelectorAll('.listing.good');
            const listingsArray = Array.from(listings);
            listingsArray.sort((a, b) => {
                const aDiff = parseInt(a.getAttribute('data-potential-profit'));
                const bDiff = parseInt(b.getAttribute('data-potential-profit'));
                return bDiff - aDiff;
            });
        
            this.listingsContainer.innerHTML = '';
            listingsArray.forEach(el => this.listingsContainer.appendChild(el));
            this.createResetButton(this.filtersContainer);
        }

        if(e.target.id === 'delete-listing') {
            const listing = e.target.closest('.listing');
            const listingId = listing.dataset.listingId;
            const confirmation = confirm("Are you sure you want to delete this item?");
            if(confirmation) {
                listing.classList.add('processing');
                deleteListing(listingId);

                setTimeout(() => {
                    listing.remove();
                }, 1000)
            }
        }


        if(e.target.id === 'listing-details') {
            const listingId = parseInt(e.target.closest('.listing').dataset.listingId);
            const listings = this.state.listings.data;
            this.state.currentListingData = listings.find(obj => obj.id === listingId);

            if(this.state.currentListingData) {
                const modal = listingInfoModal(this.state.currentListingData);
                openModal(modal);
            }
        }


        if(e.target.id === 'avg-prices') {
            const modal = statsModal(this.state.models);
            openModal(modal);
        }
    }

    createResetButton = (parent) => {
        const resetButton = document.querySelector('#reset');
        if(!resetButton) {
            const resetBtn = document.createElement('span');
            resetBtn.textContent = 'Reset';
            resetBtn.setAttribute('id', 'reset');
            parent.appendChild(resetBtn);
        }
    }
}

new App();