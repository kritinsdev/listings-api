import './inc/bootstrap';
import { createListingItem, openModal, statsModal, listingInfoModal } from './inc/helpers.js';
import { fetchListings, getModels, deleteListing } from './inc/data.js';

class App {
    constructor() {
        this.state = {
            listings: [],
            models:[],
            selectedModel: null,
            selectedSite: null,
            currentListingData: null,
            filters: {
                category: 1
            }
        },

        this.pageBody = document.querySelector('body');
        this.pageLoader = document.querySelector('.loader');
        this.listingsContainer = document.querySelector('.listings');
        this.statsContainer = document.querySelector('.stats');
        this.filtersContainer = document.querySelector('.filters');
        this.modelsOptions = document.querySelector('#models');
        this.siteOption = document.querySelector('#site');
        this.events();
    }

    events() {
        window.onload = this.initApp();
        document.addEventListener('click', this.handleClick);
        this.modelsOptions.addEventListener('change', this.getModelListings);
        this.siteOption.addEventListener('change', this.getSiteListings);
    }

    initApp = async () => {
        this.state.listings = await fetchListings();
        this.state.models = await getModels(this.state.filters.category);

        this.createModelOptions();
        this.createListingsGrid();

        this.pageLoader.remove();
        this.pageBody.style.overflow = 'initial';
    }

    getModelListings = async (e) => {
        this.state.selectedModel = e.target.value;
        this.listingsContainer.classList.add('processing');
        
        if (this.state.selectedModel) {        
            const modelListings = await fetchListings({id: this.state.selectedModel, site: this.state.selectedSite});
            console.log(modelListings);
            this.listingsContainer.innerHTML = '';
            
            if (modelListings.length > 0) {
                for (let i = 0; i < modelListings.length; i++) {
                    const itemElement = createListingItem(modelListings[i]);
                    this.listingsContainer.appendChild(itemElement);
                }
                
            } else {
                this.listingsContainer.innerHTML = '<p>No results found</p>';
            }
            this.createResetButton(this.filtersContainer);
            this.listingsContainer.classList.remove('processing');
        }
    }


    getSiteListings = async (e) => {
        this.state.selectedSite = e.target.value;

        const modelListings = await fetchListings({id: this.state.selectedModel, site: this.state.selectedSite});

        this.createListingsGrid(modelListings);
        
        this.createResetButton(this.filtersContainer);

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
            e.target.remove();

            this.state.selectedModel = null;
            this.modelsOptions.value = '';
            this.siteOption.value = '';
            this.resetProfitFilter();
            this.createListingsGrid();
        }

        if(e.target.dataset.filter === 'profit') {
            const filterBtn = e.target;
            const direction = filterBtn.dataset.direction;
            const arrow = e.target.querySelector('span');
            const listings = document.querySelectorAll('.listing.profitBadge');
            const listingsArray = Array.from(listings);
            
            if(direction == 'asc') {
                listingsArray.sort((a, b) => parseInt(b.getAttribute('data-potential-profit')) - parseInt(a.getAttribute('data-potential-profit')));
                filterBtn.setAttribute('data-direction', 'desc');
                arrow.innerHTML = '&uarr;'
            } else {
                listingsArray.sort((a, b) => parseInt(a.getAttribute('data-potential-profit')) - parseInt(b.getAttribute('data-potential-profit')));
                filterBtn.setAttribute('data-direction', 'asc');
                arrow.innerHTML = '&darr;'
            }
        
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
            const listings = this.state.listings;
            this.state.currentListingData = listings.find(obj => obj.id === listingId);

            if(this.state.currentListingData) {
                const modal = listingInfoModal(this.state.currentListingData);
                openModal(modal);
            }
        }


        if(e.target.closest('#avg-prices')) {
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

    createListingsGrid(listings) {
        let list = this.state.listings;
        if(listings) list = listings;

        this.listingsContainer.innerHTML = '';
        for (let i = 0; i < list.length; i++) {
            const itemElement = createListingItem(list[i]);
            this.listingsContainer.appendChild(itemElement);
        }
    }

    resetProfitFilter() {
        const el = document.querySelector('[data-filter="profit"]');
        el.setAttribute('data-direction', 'asc');
        el.querySelector('span').innerHTML = '';
    }
}

new App();