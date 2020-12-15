<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div x-data="tokens()" x-init="fetchTokens()">
                        <div>
                            <input type="text" x-model="tokenName" placeholder="Token name" class="flex-1 appearance-none rounded shadow p-3 text-grey-dark mr-2 focus:outline-none">

                            <button @click="createToken()" class="btn-primary transition duration-300 ease-in-out focus:outline-none focus:shadow-outline bg-purple-700 hover:bg-purple-900 text-white font-normal py-2 px-4 mr-1 rounded">
                                Create token
                            </button>
                        </div>

                        <div x-show="lastCreatedToken">
                            <h5 class="mt-5">Last created token</h5>
                            <p class="my-3 px-5 text-xs break-all">
                                ID: <span x-text="lastCreatedToken && lastCreatedToken.id"></span>
                            </p>
                            <p class="my-3 px-5 text-xs break-all">
                                Access token: <span x-text="accessToken"></span>
                            </p>
                        </div>

                        <h3 class="mt-5">Your access tokens</h3>

                        <table>
                            <thead>
                            <tr>
                                <th class="p-5">ID</th>
                                <th class="p-5">Name</th>
                                <th class="p-5">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <template x-for="token in tokens" :key="token.id">
                                <tr>
                                    <td x-text="token.id" class="p-5"></td>
                                    <td x-text="token.name" class="p-5"></td>
                                    <td class="p-5">
                                        <button @click="deleteToken(token.id)">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </template>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function tokens() {
        return {
            tokenName: '',
            accessToken: '',
            lastCreatedToken: null,
            tokens: [],
            fetchTokens: function() {
                axios.get('/oauth/personal-access-tokens')
                    .then(res => {
                        this.tokens = res.data;
                    });
            },
            createToken: function() {
                axios.post('/oauth/personal-access-tokens', {name: this.tokenName || 'some name'})
                    .then(res => {
                        this.accessToken = res.data.accessToken;
                        this.lastCreatedToken = res.data.token;

                        this.fetchTokens();
                    });
            },
            deleteToken: function(id) {
                axios.delete('/oauth/personal-access-tokens/' + id)
                    .then(res => {
                        this.fetchTokens();
                    });
            },
        };
    }
</script>
