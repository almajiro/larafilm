<template>
    <div>
        <!--
        <b-carousel id="carousel1"
                    style="text-shadow: 1px 1px 2px #333;"
                    controls
                    indicators
                    background="#ababab"
                    :interval="3000"
                    img-height="480"
                    v-model="slide"
                    @sliding-start="onSlideStart"
                    @sliding-end="onSlideEnd"
        >
            <div v-for="anime in animes">
                <b-carousel-slide :caption=anime.synonyms
                                  text=""
                                  :img-src=anime.background
                ></b-carousel-slide>
            </div>
        </b-carousel>
        -->
        <b-jumbotron>
            <template slot="header">
                Animex
            </template>
            <template slot="lead">
                The animex is Laravel based netflix,hulu alternative SPA.
            </template>
            <hr class="my-4">
            <p>
                Laravel / Vue.js
            </p>
            <b-btn variant="primary" href="#">See on the GitHub</b-btn>
            <b-btn variant="success" href="#">Contribute this project</b-btn>
        </b-jumbotron>
        <b-container fluid>
            <b-row>
                <b-col>
                    <div id="card-container" data-offset="2">
                        <div class="pg">
                            <img :src=banner.clearart>
                        </div>
                        <div id="card" v-bind:style="{ background: 'url(' + banner.background + ')' }">
                            <div class="shine"></div>
                            <div class="text-block">
                                <h1>{{ banner.synonyms }} <small>(2016)</small></h1>
                                <h3>Action, Adventure, Sci-Fi</h3>
                                <p>{{ banner.synopsis }}</p>
                                <router-link :to="{name: 'animeWatchClip', params: {animeId: banner.id}}">WATCH NOW</router-link>
                            </div>
                        </div>
                    </div>
                </b-col>
            </b-row>
            <b-row>
                <b-col v-for="anime in animes" cols=12 :key=anime.id>
                    <div class="movie_card">
                        <router-link :to="{name: 'animeWatchClip', params: {animeId: anime.id}}">
                        <div class="info_section">
                            <div class="movie_header">
                                <img class="locandina" :src="anime.poster" />
                                <h1>{{ anime.synonyms }}</h1>
                                <h4>{{ anime.name }}</h4>
                                <span class="minutes">117 min</span>
                                <p class="type">Action, Crime, Fantasy</p>
                            </div>
                            <div class="movie_desc">
                                <p class="text">{{ anime.synopsis }}</p>
                            </div>
                            <div class="movie_social">
                                <ul>
                                    <li><i class="material-icons">share</i></li>
                                    <li><i class="material-icons"></i></li>
                                    <li><i class="material-icons">chat_bubble</i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="blur_back" v-bind:style="{ backgroundImage: 'url(' + anime.background + ')' }"></div>
                        </router-link>
                    </div>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
    export default {
        name: 'ExampleComponent',
        data() {
            return {
                animes: [],
                banner: {},
                slide: 0,
                sliding: null
            }
        },
        created: function () {
            this.fetchAllAnimes()
            this.fetchAnime()
        },
        methods: {
            fetchAllAnimes() {
                this.$http.get('/api/anime')
                    .then(response => {
                    this.animes = response.data
                })
            },
            fetchAnime() {
                this.$http.get('/api/anime/9')
                    .then(response => {
                        this.banner = response.data
                    })
            },
            onSlideStart (slide) {
                this.sliding = true
            },
            onSlideEnd (slide) {
                this.sliding = false
            }
        }
    }
</script>

<style scoped>
    .carosuel img{
        height: 200px;
    }
    .jumbotron {
        border-radius: 0px;
    }
</style>
