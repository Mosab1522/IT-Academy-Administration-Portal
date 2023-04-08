<x-layout />
<x-setting heading="Študenti">
    <div class="flex flex-col">
        <form method="get" action="{{ route('admin.applications.index') }}">
            <div class="form-group">
                <label for="orderBy">Zoradiť podľa</label>
                <select class="form-control" id="orderBy" name="orderBy">
                    <option value="created_at">Dátumu vytvorenia</option>
                    <option value="updated_at">Dátumu poslednej úpravy</option>
                </select>
            </div>
            <div class="form-group">
                <label for="orderDirection">Smer zoradenia</label>
                <select class="form-control" id="orderDirection" name="orderDirection">
                    <option value="asc">Vzostupne</option>
                    <option value="desc">Zostupne</option>
                </select>
            </div>
            <div class="form-group">
                <label for="filterBy">Filtrovať podľa</label>
                <select class="form-control" id="filterBy" name="filterBy[]" multiple>
                    <option value="academy_id|1">Akadémia 1</option>
                    <option value="academy_id|2">Akadémia 2</option>
                    <option value="coursetype_id|1">Typ kurzu 1</option>
                    <option value="coursetype_id|2">Typ kurzu 2</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filtrovať a zoradiť</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Meno a priezvisko</th>
                    <th>Email</th>
                    <th>Akadémia</th>
                    <th>Typ kurzu</th>
                    <th>Dátum vytvorenia</th>
                    <th>Dátum úpravy</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $application)
                <tr>
                    <td>{{ $application->id }}</td>
                    <td>{{ $application->student->name }} {{ $application->student->surname }}</td>
                    <td>{{ $application->student->email }}</td>
                    <td>{{ $application->academy->name }}</td>
                    <td>{{ $application->coursetype->name }}</td>
                    <td>{{ $application->created_at }}</td>
                    <td>{{ $application->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    </div>

</x-setting>