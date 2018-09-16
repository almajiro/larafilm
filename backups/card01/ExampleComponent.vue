<template>
    <div>
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
        <b-jumbotron>
            <template slot="header">
                Vue.js is AWESOME!! (Laravel/Vue.js/Webpack)
            </template>
            <template slot="lead">
                This is a simple hero unit, a simple jumbotron-style component for
                calling extra attention to featured content or information.
            </template>
            <hr class="my-4">
            <p>
                It uses utility classes for typography and spacing to space content
                out within the larger container.
            </p>
            <b-btn variant="primary" href="#">Do Something</b-btn>
            <b-btn variant="success" href="#">Do Something Else</b-btn>
        </b-jumbotron>
        <b-container fluid>
            <b-row>
                <b-col>
                    <div class="movie_card" v-for="anime in animes">
                        <div class="info_section">
                            <div class="movie_header">
                                <img class="locandina" :src="anime.poster" />
                                <h1>{{ anime.synonyms }}</h1>
                                <h4>2017, David Ayer</h4>
                                <span class="minutes">117 min</span>
                                <p class="type">Action, Crime, Fantasy</p>
                            </div>
                            <div class="movie_desc">
                                <p class="text">
                                    Set in a world where fantasy creatures live side by side with humans. A human cop is forced to work with an Orc to find a weapon everyone is prepared to kill for.
                                </p>
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
                slide: 0,
                sliding: null
            }
        },
        created: function () {
            this.fetchAllAnimes()
        },
        methods: {
            fetchAllAnimes() {
                this.$http.get('/api/anime')
                    .then(response => {
                    this.animes = response.data
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
