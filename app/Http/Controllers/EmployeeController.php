<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\src\MaSPack\Application\Employee\Service\ListEmployees;
use App\src\MaSPack\Application\Employee\CommandHandler\ImportEmployeesCommandHandler;
use App\src\MaSPack\Application\Employee\Command\ImportEmployeesCommand;

use App\src\MaSPack\Infrastructure\Exceptions\ImportFilePathEmptyException;
use App\src\MaSPack\Infrastructure\Exceptions\EmployeeCouldNotBeDeletedException;
use App\src\MaSPack\Infrastructure\Exceptions\EmployeeCouldNotBeStoredException;
use App\src\MaSPack\Application\Exceptions\ImportFileNotSupportedException;
use App\src\MaSPack\Domain\Exceptions\EmployeeEntityVoidNameException;
use App\src\MaSPack\Domain\Exceptions\EmployeeEntityVoidEmailException;

class EmployeeController extends Controller
{
    private $listEmployees;
    private $importEmployeesCommandHandler;

    public function __construct(ListEmployees $listEmployees,
        ImportEmployeesCommandHandler $importEmployeesCommandHandler
    )
    {
        $this->middleware('auth');

        $this->listEmployees = $listEmployees;
        $this->importEmployeesCommandHandler = $importEmployeesCommandHandler;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $listOfEmployees = $this->listEmployees->execute();
            return view('EmployeeList')->with('listOfEmployees', $listOfEmployees);
        } catch (EmployeeCouldNotBeReadedException $exception) {
            return $this->index()->with('errorMessage', "Something happened while reading employees from DataBase");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $importFile = $request->file('importFile');

            if(!isset($importFile)){
                throw new ImportFilePathEmptyException();
            }
            $command = new ImportEmployeesCommand(
                $importFile->getRealPath(),
                $importFile->getClientOriginalExtension()
            );

            $this->importEmployeesCommandHandler->handle($command);
        } catch (ImportFilePathEmptyException $exception) {
            return $this->index()->with('errorMessage', "Please, select first a file into before continue");
        } catch (EmployeeCouldNotBeDeletedException $exception) {
            return $this->index()->with('errorMessage', "Something happened while deleting employees from DataBase");
        } catch (EmployeeCouldNotBeStoredException $exception) {
            return $this->index()->with('errorMessage', "Something happened while storing employees from DataBase");
        } catch (ImportFileNotSupportedException $exception) {
            return $this->index()->with('errorMessage', "The file you selected doesn't have a supported extension");
        } catch (EmployeeEntityVoidNameException $exception) {
            return $this->index()->with('errorMessage', "Employee Name void while trying to build Employee");
        } catch (EmployeeEntityVoidEmailException $exception) {
            return $this->index()->with('errorMessage', "Employee Email void while trying to build Employee");
        }

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
