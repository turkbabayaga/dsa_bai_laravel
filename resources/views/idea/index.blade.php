<x-app-layout> 
    <!--Bloc principal--> 
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8"> 
        <!--Creer des idea--> 
        <form method="POST" action="{{ route('idea.store') }}"> 
            @csrf
            <a>Titre de l'idée</a> 
            <input 
                name="title" 
                placeholder="{{ __('What\'s on your mind?') }}" 
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
            >{{ old('title') }}</input>
            <a>Application liée à l'idée</a> 
            <input 
                name="application" 
                placeholder="{{ __('What\'s on your mind?') }}" 
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
            >{{ old('application') }}</input> 
            <a>Message</a> 
            <textarea 
                name="message" 
                placeholder="{{ __('What\'s on your mind?') }}" 
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
            >{{ old('message') }}</textarea> 
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Envoyer') }}</x-primary-button> 
            @if ($errors->has('message_limit_idee'))
                <div style="color: red; margin-top: 10px;">
                    {{ $errors->first('message_limit_idee') }}
                </div>
            @endif
        </form> 
        <!--Visualiser les idea du user--> 
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y"> 
            @foreach ($idea as $idea) 
                <div class="p-6 flex space-x-2"> 
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> 
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /> 
                    </svg> 
                    <div class="flex-1"> 
                        <div class="flex justify-between items-center"> 
                            <div> 
                                <span class="text-gray-800">{{ $idea->user->name }}</span> 
                                <small class="ml-2 text-sm text-gray-600">{{ $idea->created_at->format('j M Y, g:i a') }}</small> 
                                <!--Affichage de l'information indiquant qu'un idea a été modifié--> 
                                @unless ($idea->created_at->eq($idea->updated_at)) 
                                    <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small> 
                                @endunless 
                            </div>
                            <!--Affichage du lien permettant d'éditer un idea si il a été créé par l'utilisateur--> 
                            @if ($idea->user->is(auth()->user())) 
                            <x-dropdown> 
                                <x-slot name="trigger"> 
                                    <button> 
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor"> 
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" /> 
                                        </svg> 
                                    </button> 
                                </x-slot> 
                                <x-slot name="content"> 
                                    <x-dropdown-link :href="route('idea.edit', $idea)"> 
                                        {{ __('Edit') }} 
                                    </x-dropdown-link> 
                                    <form method="POST" action="{{ route('idea.destroy', $idea) }}"> 
                                    @csrf 
                                    @method('delete') 
                                        <x-dropdown-link :href="route('idea.destroy', $idea)" onclick="event.preventDefault(); this.closest('form').submit();"> 
                                            {{ __('Delete') }} 
                                        </x-dropdown-link> 
                                    </form> 
                                </x-slot> 
                            </x-dropdown> 
                            @endif 
                        </div> 
                        <p class="mt-4 text-lg text-gray-900">Titre : {{ $idea->title }}</p>
                        <p class="mt-2 text-gray-900">Application : {{ $idea->application }}</p>
                        <p class="mt-2 text-gray-900">Message : {{ $idea->message }}</p> 
                    </div> 
                </div> 
                <form method="POST" action="{{route('comments.store')}}">
                    @csrf
                    <x-primary-button class="mt-4">{{ __('Commenter') }}</x-primary-button> 
                    <input name="idea_id" hidden value="{{$idea -> id}}">
                    <textarea name="content" placeholder="Commentez cette idée"></textarea>
                </form>
            @endforeach
        </div> 
    </div> 
</x-app-layout> 