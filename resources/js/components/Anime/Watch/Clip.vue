<template>
    <div>
        <b-container fluid>
            <b-row class="player-box">
                <b-col cols="8" offset="2">
                    <video-player :options=playerOptions></video-player>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                anime: [],
                playerOptions: {}
            }
        },
        created: function () {
            this.fetchAnime()
        },
        methods: {
            fetchAnime() {
                this.$http.get('/api/anime/' + this.$route.params.animeId)
                    .then(response => {
                        this.anime = response.data
                        this.playerOptions = {
                            muted: false,
                            autoplay: true,
                            sources: [{
                                type: "video/mp4",
                                src: this.anime.clip
                            }],
                            fluid: true,
                            poster: this.anime.background,
                            inactivityTimeout: 0
                        }
                    })
            },
        }
    }
</script>

<style scoped>
    .player-box {
        background-color: black;
    }
</style>
